<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderCheckup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OrderCheckupsController extends Controller
{
    public function index(Order $order)
    {
        return view('pages.order.lab.index', compact(['order']));
    }

    //////////////////////////////////////////////
    public function getList($orderId)
    {
        $orderCheckup = new OrderCheckup();
        $info = $orderCheckup->getByOrder($orderId);
        $datatable = Datatables::of($info);
        $datatable->editColumn('checkup_id', function ($row) {
            return $row->checkup != null ? $row->checkup->name : '';
        });

        $datatable->editColumn('price', function ($row) {
            return $row->checkup != null ? $row->checkup->price : '';
        });

        $datatable->editColumn('code', function ($row) {
            return $row->checkup != null ? $row->checkup->no : '';
        });

        $datatable->editColumn('created_at', function ($row) {
            return $row->created_at->format('d-m-y H:m');;
        });

        $datatable->editColumn('payment_status', function ($row) {
            $paymentStatus = '';
            $color = '#ff0000';
            if ($row->payment_status == 0) {
                $paymentStatus = 'غير مدفوع';
                $color = '#ff0000';
            } else if ($row->payment_status == 1) {
                $paymentStatus = 'غير مدفوع';
                $color = '#ff0000';
            } else if ($row->payment_status == 2) {
                $paymentStatus = 'مدفوع';
                $color = '#00b559';
            }
            return '<span style="font-weight: bold ; color: ' . $color . ';">' . $paymentStatus . '</span>';
        });

        $datatable->editColumn('status', function ($row) {
            $data['id'] = $row->id;
            $data['status'] = $row->status;
            return view('pages.order.parts._checkup-status', $data)->render();
        });
//        $datatable->addColumn('actions', function ($row) {
//            $data['id'] = $row->id;
//            $data['note'] = $row->result;
//            return view('pages.order.parts._checkup-action-menu', $data)->render();
//        });

        $datatable->escapeColumns(['*']);
        return $datatable->make(true);
    }

    //////////////////////////////////////////////////
    public function postAdd(Request $request): \Illuminate\Http\JsonResponse
    {
        $checkup_id = $request->get('checkup_id');
        $orderId = $request->get('order_id');
        $userId = Auth::guard()->user()->id;

        $orderCheckup = OrderCheckup::create([
            'order_id' => $orderId,
            'checkup_id' => $checkup_id,
            'user_id' => $userId
        ]);
        if ($orderCheckup) {
            $order = Order::find($orderId);
            $order->update(['in_lab' => 1]);
            return response()->json(array(
                'success' => true,
                'message' => 'تمت الاضافة بنجاح',
            ), 200);
        } else {
            return response()->json(array(
                'success' => false,
                'message' => 'حدث خطأ'
            ), 200);
        }
    }

    //////////////////////////////////////////////////
    public function postAddCheckup(Request $request)
    {
        $userId = Auth::guard()->user()->id;
        $orderId = $request->get('order_id');
        $checkupList = $request->get('checkup_list');
        $order = Order::find($orderId);
        foreach ($order->checkups as $item) {
            $item->delete();
        }

        if ($checkupList != null) {
            if (sizeof($checkupList) > 0) {
                foreach ($checkupList as $item) {
                    OrderCheckup::create([
                        'order_id' => $orderId,
                        'checkup_id' => $item,
                        'user_id' => $userId
                    ]);
                }
                $order->update(['in_lab' => 1]);
                return response()->json(['status' => 'success', 'message' => 'تمت الاضافة بنجاح']);

            } else {
                return response()->json(['status' => 'error', 'message' => 'يرجى الاختيار اولاً']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'يرجى الاختيار اولاً']);

        }
    }

    //////////////////////////////////////////////
    public function status(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('id');
        $info = OrderCheckup::find($id);
        $order = Order::find($info->order_id);
        if ($order->status > 2 && $order->lab_payment > 0) {
            return response()->json(['status' => 'error', 'message' => trans('لا يمكن تعديل البيانات بعد الدفع!')]);
        } else {
            return updateModelStatus($info);
        }
    }

    //////////////////////////////////////////////////
    public function postDelete($id): \Illuminate\Http\JsonResponse
    {
        $orderCheckup = OrderCheckup::find($id);
        if ($orderCheckup) {
            $orderId = $orderCheckup->order_id;
            $orderCheckup->delete();
            $order = Order::find($orderId);
            if ($order && sizeof($order->checkups) == 0) {
                $order->update(['in_lab' => 0]);
            }
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////
    public function total(Request $request): int
    {
        $total = 0;
        $orderId = $request->get('id');
        $orderCheckup = new OrderCheckup();
        $info = $orderCheckup->getByOrder($orderId);
        if ($info) {
            foreach ($info as $item) {
                $total += $item->checkup->price;
            }
        }

        return $total;
    }

    //////////////////////////////////////////////////
    public function print($type, Order $order)
    {
        $nowDate = Carbon::now();
        $date = $nowDate->format('d-m-Y');
        return view('pages.order.lab.print', compact(['order', 'date', 'type']));
    }
}
