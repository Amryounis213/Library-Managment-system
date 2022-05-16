<?php

namespace App\Http\Controllers;

use App\Events\OrderEvent;
use App\Models\Order;
use App\Models\OrderCheckup;
use App\Models\OrderMedicine;
use App\Models\OrderXray;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class OrderCollectionsController extends Controller
{
    public function index(Order $order)
    {
        $nowDate = Carbon::now();
        $date = $nowDate->format('d-m-Y');

        return view('pages.order.collections.index', compact(['order', 'date']));
    }

    //////////////////////////////////////////////
    public function getList($orderId)
    {
        $order = Order::find($orderId);
        $info = array();
        $i = 1;

        if (sizeof($order->medicines) > 0 && $order->pharmacy_payment > -1) {
            foreach ($order->medicines as $item) {
                if ($item->payment_status < 2 && $item->status == 1) {
                    $infoItem = new \stdClass();
                    $infoItem->id = $i;
                    $infoItem->item_id = $item->id;
                    $infoItem->type = 'medicine';
                    $infoItem->service = 'أدوية';
                    $infoItem->name = $item->medicine->name;
                    $infoItem->unit = $item->medicine->unit;
                    $infoItem->quantity = $item->quantity;
                    $infoItem->price = getDecimal($item->net_price);
                    $infoItem->sub_total = getDecimal($item->net_price * $item->quantity);
                    $infoItem->status = $item->payment_status;
                    $info[] = $infoItem;
                    $i++;
                }
            }
        }
        if (sizeof($order->checkups) > 0 && $order->lab_payment > -1) {
            foreach ($order->checkups as $item) {
                if ($item->payment_status < 2 && $item->status == 1) {
                    $infoItem = new \stdClass();
                    $infoItem->id = $i;
                    $infoItem->item_id = $item->id;
                    $infoItem->type = 'checkup';
                    $infoItem->service = 'تحاليل مخبرية';
                    $infoItem->name = $item->checkup->name;
                    $infoItem->unit = $item->checkup->no;
                    $infoItem->quantity = 1;
                    $infoItem->price = '-'; //getDecimal($item->checkup->price);
                    $infoItem->sub_total = '-'; //getDecimal($item->checkup->price);
                    $infoItem->status = $item->payment_status;
                    $info[] = $infoItem;
                    $i++;
                }
            }
        }
        if (sizeof($order->xrays) > 0 && $order->xray_payment > -1) {
            foreach ($order->xrays as $item) {
                if ($item->payment_status < 2 && $item->status == 1) {
                    $infoItem = new \stdClass();
                    $infoItem->id = $i;
                    $infoItem->item_id = $item->id;
                    $infoItem->type = 'xray';
                    $infoItem->service = 'صور أشعة';
                    $infoItem->name = $item->xray->name;
                    $infoItem->unit = $item->xray->no;
                    $infoItem->quantity = 1;
                    $infoItem->price = '-'; //getDecimal($item->xray->price);
                    $infoItem->sub_total = '-'; //getDecimal($item->xray->price);
                    $infoItem->status = $item->payment_status;
                    $info[] = $infoItem;
                    $i++;
                }
            }
        }
        $datatable = Datatables::of($info);
        $datatable->editColumn('status', function ($row) {
            $data['id'] = $row->item_id;
            $data['type'] = $row->type;
            $data['status'] = $row->status;
            return view('pages.order.parts._collection-status', $data)->render();
        });

        $datatable->escapeColumns(['*']);
        return $datatable->make(true);
    }

    //////////////////////////////////////////////
    public function status(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('id');
        $type = $request->get('type');
        if ($type == 'medicine') {
            $info = OrderMedicine::find($id);
            return updatePaymentStatus($info);
        } else if ($type == 'checkup') {
            $info = OrderCheckup::find($id);
            return updatePaymentStatus($info);
        } else if ($type == 'xray') {
            $info = OrderXray::find($id);
            return updatePaymentStatus($info);
        } else {
            return response()->json(['status' => 'error', 'message' => trans('لا يمكن تعديل حالة الدفع!')]);
        }
    }

    //////////////////////////////////////////////
    public function payOrder(Request $request): \Illuminate\Http\RedirectResponse
    {
        $id = $request->get('order_id');
        $medicineTotal = 0;
        $checkupTotal = 0;
        $xraysTotal = 0;
        $r1 = 0;
        $r2 = 0;
        $r3 = 0;
        $order = Order::find($id);
        if ($order) {
            if (sizeof($order->medicines) > 0 && $order->pharmacy_payment > -1) {
                foreach ($order->medicines as $item) {
                    if ($item->status == 1 && $item->payment_status == 1) {
                        $medicineTotal += $item->net_price * $item->quantity;
                        $item->update(['payment_status' => 2]);
                    }
                }
            }
            if (sizeof($order->checkups) > 0 && $order->lab_payment > -1) {
                foreach ($order->checkups as $item) {
                    if ($item->status == 1 && $item->payment_status == 1) {
                        $checkupTotal += $item->checkup->price;
                        $item->update(['payment_status' => 2]);
                    }
                }
            }
            if (sizeof($order->xrays) > 0 && $order->xray_payment > -1) {
                foreach ($order->xrays as $item) {
                    if ($item->status == 1 && $item->payment_status == 1) {
                        $xraysTotal += $item->xray->price;
                        $item->update(['payment_status' => 2]);
                    }
                }
            }
            $total = $medicineTotal + $checkupTotal + $xraysTotal;
            $order->update(['total' => $total]);
            if ($medicineTotal > 0) {
                $order->update(['pharmacy_payment' => $medicineTotal]);
                $r1 = 10;

            }
            if ($checkupTotal > 0) {
                $order->update(['lab_payment' => $checkupTotal]);
                $r2 = 12;

            }
            if ($xraysTotal > 0) {
                $order->update(['xray_payment' => $xraysTotal]);
                $r3 = 13;

            }
            $updatedOrder = Order::find($order->id);
            $finalTotal = $this->getOrderFinalTotal($updatedOrder);
            if ($finalTotal == 0) {
                $order->update(['status' => 5]);
            } else {
                $order->update(['status' => 4]);
            }
            $user = new User();
            $receivers = $user->getDeskUsers($r1, $r2, $r3);
            if ($receivers) {
                foreach ($receivers as $receiver) {
                    event(new OrderEvent($receiver));
                }
            }
            return redirect()->route('order.index', $order)
                ->with('success', 'تم الدفع بنجاح');
        } else {
            return redirect()->route('order.collections', $order)
                ->with('danger', 'حدث خطأ');
        }
    }

    //////////////////////////////////////////////
    public function getOrderFinalTotal($order): int
    {
        $total = 0;
        if ($order->medicines) {
            foreach ($order->medicines as $item) {
                if ($item->status == 1 && $item->payment_status < 2) {
                    $total += $item->net_price * $item->quantity;
                }
            }
        }
        if ($order->checkups) {
            foreach ($order->checkups as $item) {
                if ($item->payment_status < 2) {
                    $total += $item->checkup->price;
                }
            }
        }
        if ($order->xrays) {
            foreach ($order->xrays as $item) {
                if ($item->payment_status < 2) {
                    $total += $item->xray->price;
                }
            }
        }
        return $total;
    }

    //////////////////////////////////////////////////
    public function print(Order $order)
    {
        $nowDate = Carbon::now();
        $date = $nowDate->format('d-m-Y');

        return view('pages.order.collections.print', compact(['order', 'date']));
    }

}
