<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\Diagnosis;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderDiagnosis;
use App\Models\User;
use App\Models\Xray;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class OrderDiagnosticsController extends Controller {

    //////////////////////////////////////////////////
    public function index(Order $order) {
        $checkups = Checkup::all();
        $xrays = Xray::all();
        $medicines = Medicine::all();
        $orderCheckups = array();
        foreach ($order->checkups as $item) {
            $orderCheckups[] = $item->checkup->id;
        }

        $orderXrays = array();
        foreach ($order->xrays as $item) {
            $orderXrays[] = $item->xray->id;
        }
        return view('pages.order.doctor.index', compact(['order', 'checkups', 'xrays', 'medicines', 'orderCheckups', 'orderXrays']));
    }

    //////////////////////////////////////////////
    public function getList($orderId) {
        $orderDiagnosis = new OrderDiagnosis();
        $info = $orderDiagnosis->getByOrder($orderId);
        $datatable = Datatables::of($info);
        $datatable->editColumn('diagnosis_id', function ($row) {
            return $row->diagnosis != null ? $row->diagnosis->description : '';
        });
        $datatable->editColumn('created_at', function ($row) {
            return $row->created_at->format('d-m-y H:m');
            ;
        });
        $datatable->addColumn('actions', function ($row) {
            $data['id'] = $row->id;
            return view('pages.order.parts._diagnosis-action-menu', $data)->render();
        });

        $datatable->escapeColumns(['*']);
        return $datatable->make(true);
    }

    //////////////////////////////////////////////////
    public function postAdd(Request $request): \Illuminate\Http\JsonResponse {
        $description = $request->get('description');
        $orderId = $request->get('order_id');
        $userId = Auth::guard()->user()->id;

        $diagnosis = Diagnosis::create([
                    'description' => $description,
                    'user_id' => $userId
        ]);

        if ($diagnosis) {
            $orderDiagnosis = OrderDiagnosis::create([
                        'order_id' => $orderId,
                        'diagnosis_id' => $diagnosis->id,
                        'user_id' => $userId
            ]);
            if ($orderDiagnosis) {
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
        } else {
            return response()->json(array(
                        'success' => false,
                        'errors' => 'حدث خطأ'
                            ), 200);
        }
    }

    //////////////////////////////////////////////////
    public function postDelete($id): \Illuminate\Http\JsonResponse {
        $orderDiagnosis = OrderDiagnosis::find($id);
        if ($orderDiagnosis) {
            $orderDiagnosis->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////////
    public function display(Order $order) {
        $nowDate = Carbon::now();
        $date = $nowDate->format('d-m-Y');
        return view('pages.order.doctor.display', compact(['order', 'date']));
    }

    //////////////////////////////////////////////////
    public function getByClinic(Request $request) {
        $id = $request->get('id');
        $user = new User();
        return $user->getByClinic($id);
    }

    //////////////////////////////////////////////////
    public function getPatientOrder(Request $request) {
        $doctorId = $request->get('doctor_id');
        $identity = $request->get('identity');
        $date = '';
        $order = new Order();
        $isPast = false;
        $result = $order->getByDoctorPatient($doctorId, $identity);
        if ($result) {
            $date = date('d-m-Y', strtotime($result->created_at));
            $r = $result->created_at->format('m/d/Y H:i:s');
            $date1 = Carbon::createFromFormat('m/d/Y H:i:s', $r)->addDays(10);
            $date2 = Carbon::now();
            $now = new DateTime('now');
            $nowDate = $now->format('d-m-Y');
            if ($date2->gt($date1)) {
                $isPast = true;
            }
        }
        return response()->json(['status' => 'success', 'message' => $date, 'pass' => $isPast]);
    }

    //////////////////////////////////////////////////
    public function checkLastVisit($doctorId, $bookingTime, $no) {
        $result = fasle;
        $checkout = Carbon::createFromFormat('m/d/Y H:i:s', $checkoutTime)->subMinutes($visitDuration);
        if ($booking->gte($attendance) && $booking->lte($checkout)) {
            
        }
        return $result;
    }

}
