<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderXray;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OrderXraysController extends Controller
{
    public function index(Order $order)
    {
        return view('pages.order.xrayRoom.index', compact(['order']));
    }

    //////////////////////////////////////////////
    public function getList($orderId)
    {
        $orderXray = new OrderXray();
        $info = $orderXray->getByOrder($orderId);
        $datatable = Datatables::of($info);
        $datatable->editColumn('xray_id', function ($row) {
            return $row->xray != null ? $row->xray->name : '';
        });

        $datatable->editColumn('price', function ($row) {
            return $row->xray->price;
        });

        $datatable->editColumn('code', function ($row) {
            return $row->xray != null ? $row->xray->no : '';
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
            return view('pages.order.parts._xray-status', $data)->render();
        });

//        $datatable->addColumn('actions', function ($row) {
//            $data['id'] = $row->id;
//            $data['note'] = $row->note;
//            return view('pages.order.parts._xray-action-menu', $data)->render();
//        });

        $datatable->escapeColumns(['*']);
        return $datatable->make(true);
    }

    //////////////////////////////////////////////////
    public function postAdd(Request $request): \Illuminate\Http\JsonResponse
    {
        $xray_id = $request->get('xray_id');
        $orderId = $request->get('order_id');
        $instructions = $request->get('instructions');
        $userId = Auth::guard()->user()->id;

        $orderXray = OrderXray::create([
            'order_id' => $orderId,
            'xray_id' => $xray_id,
            'user_id' => $userId,
            'instructions' => $instructions,
        ]);
        if ($orderXray) {
            $order = Order::find($orderId);
            $order->update(['in_xray' => 1]);
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
    public function postAddXray(Request $request)
    {
        $userId = Auth::guard()->user()->id;
        $orderId = $request->get('order_id');
        $xrayList = $request->get('xray_list');
        $order = Order::find($orderId);
        foreach ($order->xrays as $item) {
            $item->delete();
        }

        if ($xrayList != null) {
            if (sizeof($xrayList) > 0) {
                foreach ($xrayList as $item) {
                    OrderXray::create([
                        'order_id' => $orderId,
                        'xray_id' => $item,
                        'user_id' => $userId
                    ]);
                }
                $order->update(['in_xray' => 1]);
                return response()->json(['status' => 'success', 'message' => 'تمت الاضافة بنجاح']);

            } else {
                return response()->json(['status' => 'error', 'message' => 'يرجى الاختيار اولاً']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'يرجى الاختيار اولاً']);

        }
    }

    //////////////////////////////////////////////////
    public function postDelete($id): \Illuminate\Http\JsonResponse
    {
        $orderXray = OrderXray::find($id);
        if ($orderXray) {
            $orderId = $orderXray->order_id;
            $orderXray->delete();
            $order = Order::find($orderId);
            if ($order && sizeof($order->xrays) == 0) {
                $order->update(['in_xray' => 0]);
            }
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////
    public function status(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('id');
        $info = OrderXray::find($id);
        $order = Order::find($info->order_id);
        if ($order->status > 2 && $order->xray_payment > 0) {
            return response()->json(['status' => 'error', 'message' => trans('لا يمكن تعديل البيانات بعد الدفع!')]);
        } else {
            return updateModelStatus($info);
        }
    }

    //////////////////////////////////////////////
    public function total(Request $request): int
    {
        $total = 0;
        $orderId = $request->get('id');
        $orderXray = new OrderXray();
        $info = $orderXray->getByOrder($orderId);
        if ($info) {
            foreach ($info as $item) {
                $total += $item->xray->price;
            }
        }

        return $total;
    }

    //////////////////////////////////////////////////
    public function print($type, Order $order)
    {
        $nowDate = Carbon::now();
        $date = $nowDate->format('d-m-Y');
        return view('pages.order.xrayRoom.print', compact(['order', 'date', 'type']));
    }
}
