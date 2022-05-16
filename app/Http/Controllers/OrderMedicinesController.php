<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderMedicine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class OrderMedicinesController extends Controller
{
    //////////////////////////////////////////////////
    public function index(Order $order)
    {
        $medicines = Medicine::all();

        return view('pages.order.pharmacy.index', compact(['order', 'medicines']));
    }

    //////////////////////////////////////////////
    public function getList($orderId)
    {
        $orderMedicine = new OrderMedicine();
        $info = $orderMedicine->getByOrder($orderId);
        $datatable = Datatables::of($info);
        $datatable->setRowClass(function ($row) {
            $className = '';
            if ($row->status == 1) {
                $className = "no-print";
            }
            return $className;
        });
        $datatable->editColumn('medicine_id', function ($row) {
            return $row->medicine != null ? $row->medicine->name : '';
        });
        $datatable->editColumn('price', function ($row) {
            return $row->medicine != null ? $row->medicine->price : '';
        });
        $datatable->editColumn('unit', function ($row) {
            return $row->medicine != null ? $row->medicine->unit : '';
        });
        $datatable->editColumn('times', function ($row) {
            $day = '';
            if ($row->dose_period == 1) {
                $day = 'يوميا';
            }
            if ($row->dose_period == 2) {
                $day = 'اسبوعيا';
            }
            if ($row->dose_period == 3) {
                $day = 'شهريا';
            }
            if ($row->dose_period == 4) {
                $day = 'عند اللزوم';
            }
            $result = $row->times .' (' . $day . ') ';
            return $result;
        });

        $datatable->editColumn('duration', function ($row) {
            $day = '';
            if ($row->duration_period == 1) {
                $day = 'يوم';
            }
            if ($row->duration_period == 2) {
                $day = 'اسبوع';
            }
            if ($row->duration_period == 3) {
                $day = 'شهر';
            }
            if ($row->duration_period == 4) {
                $day = 'عند اللزوم';
            }
            $result = $row->duration .' (' . $day . ') ';
            return $result;
        });

        $datatable->editColumn('user_type', function ($row) {
            $userType = 'الطبيب';
            if ($row->user != null) {
                if ($row->user->role_id == 10) {
                    $userType = 'الصيدلي';
                }
            }
            return $userType;
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
            return view('pages.order.parts._medicine-status', $data)->render();
        });
        $datatable->addColumn('actions', function ($row) {
            $data['id'] = $row->id;
            $data['net_price'] = $row->net_price;
            $data['status'] = $row->payment_status;
            return view('pages.order.parts._medicine-action-menu', $data)->render();
        });

        $datatable->escapeColumns(['*']);
        return $datatable->make(true);
    }

    //////////////////////////////////////////////////
    public function postAdd(Request $request)
    {
        $save_data = $request->all();
        $ordrId = $request->get('order_id');
        $order = Order::find($ordrId);
        $validator = Validator::make([
            'medicine_id' => $save_data['medicine_id'],
            'quantity' => $save_data['quantity'],
        ], [
            'medicine_id' => 'required',
            'quantity' => 'required|numeric|not_in:0',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 200);
        } else {
            $save_data['user_id'] = Auth::guard()->user()->id;
            $orderMedicine = OrderMedicine::create(array_merge($save_data));

            if ($orderMedicine) {
                $order->update(['in_pharmacy' => 1]);

                return response()->json(array(
                    'success' => true,
                    'status' => 'success',
                    'message' => 'تمت الاضافة بنجاح',
                ), 200);
            } else {
                return response()->json(array(
                    'success' => false,
                    'status' => 'error',
                    'errors' => ['message' => 'حدث خطأ']
                ), 400); //
            }
        }
    }

    //////////////////////////////////////////////
    public function status(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('id');
        $info = OrderMedicine::find($id);
        $order = Order::find($info->order_id);
        if ($order->status > 2 && $order->pharmacy_payment > 0) {
            return response()->json(['status' => 'error', 'message' => trans('لا يمكن تعديل البيانات بعد الدفع!')]);
        } else {
            return updateModelStatus($info);
        }
    }

    //////////////////////////////////////////////////
    public function postDelete($id): \Illuminate\Http\JsonResponse
    {
        $orderMedicine = OrderMedicine::find($id);
        if ($orderMedicine) {
            $orderId = $orderMedicine->order_id;
            $orderMedicine->delete();
            $order = Order::find($orderId);
            if ($order && sizeof($order->medicines) == 0) {
                $order->update(['in_pharmacy' => 0]);
            }

        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////////
    public function print($type, Order $order)
    {
        $nowDate = Carbon::now();
        $date = $nowDate->format('d-m-Y');
        return view('pages.order.pharmacy.print', compact(['order', 'date', 'type']));
    }

    //////////////////////////////////////////////
    public function total(Request $request): int
    {
        $total = 0;
        $orderId = $request->get('id');
        $orderMedicine = new OrderMedicine();
        $info = $orderMedicine->getByOrder($orderId);
        if ($info) {
            foreach ($info as $item) {
                if ($item->status == 1) {
                    $total += $item->net_price * $item->quantity;

                }
            }
        }

        return $total;
    }

    //////////////////////////////////////////////
    public function updateNetPrice(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = $request->get('id');
        $price = $request->get('price');

        $info = OrderMedicine::find($id);
        $update = $info->update(['net_price' => $price]);

        if ($update) {
            return response()->json(['status' => 'success', 'message' => trans('تم تعديل السعر بنجاح.'), 'type' => 'no']);
        } else {
            return response()->json(['status' => 'error', 'message' => trans('حدث خطأ')]);
        }

    }

}
