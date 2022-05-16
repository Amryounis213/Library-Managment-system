<?php

namespace App\Http\Controllers;

use App\DataTables\Orders\OrdersDataTable;
use App\Events\OrderEvent;
use App\Models\City;
use App\Models\Clinic;
use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderCheckup;
use App\Models\OrderXray;
use App\Models\Patient;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller {

    public function __construct() {
        $this->middleware('permission:orders.show')->only(['index', 'show']);
        $this->middleware('permission:orders.create')->only(['create', 'store']);
        $this->middleware('permission:orders.edit')->only(['edit', 'update', 'status']);
        $this->middleware('permission:orders.delete')->only(['destroy']);
    }

    //////////////////////////////////////////////////
    public function index(OrdersDataTable $dataTable) {
        return $dataTable->render('pages.order.index.index');
    }

    //////////////////////////////////////////////////
    public function create() {
        $user = new User();
        $doctors = $user->getByRole(9);
        $clinics = Clinic::all();
        $states = State::all();
        $cities = City::all();
        return view('pages.order.create.create', compact(['doctors', 'clinics', 'states', 'cities']));
    }

    //////////////////////////////////////////////////
    public function store(Request $request): \Illuminate\Http\RedirectResponse {
        $userId = Auth::guard()->user()->id;
        $patientId = $request->get('patient_id');
        $identity = $request->get('identity');
        $doctorId = $request->get('doctor_id');
        $dob = $request->get('dob');
        $bookingTime = $request->get('booking_time');

        if (!$bookingTime) {
            $bookingTime = Carbon::now();
            $request['booking_time'] = $bookingTime;
        } else {
            $bookingTime = Carbon::createFromFormat('d/m/Y H:i:s', $bookingTime);
            $boTime = $bookingTime->format('Y-m-d H:i:s');
            $request['booking_time'] = $boTime;
        }

        $tt = DateTime::createFromFormat('d/m/Y', $dob);
        if ($tt) {
            $request['dob'] = DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d');
        }

        if ($patientId) {
            $patient = Patient::find($patientId);
        } else {
            $patient = Patient::where('identity', $identity)->first();
        }
        if ($patient) {
            $patient->update($request->all());
        }
        $tempDate = Carbon::now();
        $date = $tempDate->addDays(10);
        $request['next_visit_date'] = $date;

        $no = $this->getNo($doctorId, $bookingTime);
        if ($no == 0) {
            $request->session()->flash('danger', 'موعد الحجز غير متوفر!');
            return Redirect::back()
                            ->withInput($request->input())
                            ->withInput();
        }
        if (!$patient) {
            $patient = Patient::create(array_merge($request->all(), ['created_by' => $userId, 'no' => $no]));
        }
        $patientId = $patient->id;
        $order = Order::create(array_merge($request->all(), ['creator_id' => $userId, 'patient_id' => $patientId, 'no' => $no]));
        if ($order) {
            $receiver = User::find($order->doctor_id);
            if ($receiver) {
                event(new OrderEvent($receiver));
            }
            return redirect()->route('order.index')
                            ->with('success', 'تمت الإضافة بنجاح.');
        } else {
            return redirect()->route('order.index')
                            ->with('danger', 'حدث خطأ!');
        }
    }

    //////////////////////////////////////////////////
    public function getNo($doctorId, $bookingTime) {
        $no = 1;
        if ($this->isToday($bookingTime)) {
            $no = $this->bookToday($doctorId, $bookingTime);
        } else {
            $no = $this->bookDate($doctorId, $bookingTime);
        }
        return $no;
    }

    //////////////////////////////////////////////////
    public function bookToday($doctorId, $bookingTime) {
        $no = 1;
        $order = new Order();
        $orders = $order->getDoctorByDateOrders($doctorId, $bookingTime);
        if (sizeof($orders) > 0) {
            $prevOrder = null;
            foreach ($orders as $currOrder) {
                if ($prevOrder) {
                    if (($currOrder->no - 1) == $prevOrder->no) {
                        $no = $currOrder->no + 1;
                    } else {
                        break;
                    }
                } else {
                    $no++;
                }
                $prevOrder = $currOrder;
            }
        }
        return $no;
    }

    //////////////////////////////////////////////////
    public function bookDate($doctorId, $bookingTime) {
        $no = 1;
        $visitDuration = 15;
        $attendanceTime = "14:00:00";
        $checkoutTime = "14:00:00";
        $currentDateTime = Carbon::now();

        $doctor = User::find($doctorId);
        if ($doctor) {
            $attendanceTime = $doctor->attendance_time;
            $checkoutTime = $doctor->checkout_time;
            $clinic = $doctor->clinic;
            if ($clinic) {
                $visitDuration = $clinic->visit_duration;
            }
        }

        $time = strtotime($bookingTime);
        $bookTime = date('m/d/Y H:i:s', $time);
        $booking = Carbon::createFromFormat('m/d/Y H:i:s', $bookTime);

        $bTime = date('m/d/Y', $time);
        $attendanceTime = $bTime . ' ' . $attendanceTime;
        $checkoutTime = $bTime . ' ' . $checkoutTime;

        $attendance = Carbon::createFromFormat('m/d/Y H:i:s', $attendanceTime);
        $checkout = Carbon::createFromFormat('m/d/Y H:i:s', $checkoutTime)->subMinutes($visitDuration);
        if ($booking->gte($attendance) && $booking->lte($checkout)) {
            $totalDuration = $booking->diffInSeconds($attendance);
            $dMinutes = 0;
            if ($totalDuration > 0) {
                $dMinutes = $totalDuration / 60;
            }
            if ($dMinutes >= $visitDuration) {
                $dMinutes = $dMinutes / $visitDuration;
            }
            $no = (int) ceil($dMinutes);
            if ($no < 1)
                $no = 1;
            $result = $this->checkNo($doctorId, $bookingTime, $no);
            if (!$result) {
                $no = 0;
            }
        } else {
            $no = 0;
        }

        return $no;
    }

    //////////////////////////////////////////////////
    public function checkNo($doctorId, $bookingTime, $no) {
        $result = true;
        $order = new Order();
        $orders = $order->getDoctorByDateOrders($doctorId, $bookingTime);
        if (sizeof($orders) > 0) {
            foreach ($orders as $currOrder) {
                if ($no == $currOrder->no) {
                    $result = false;
                    break;
                }
            }
        }
        return $result;
    }

    //////////////////////////////////////////////////
    public function isToday($bookingTime) {
        $result = true;
        if ($bookingTime) {
            $time = strtotime($bookingTime);
            $bTime = date('Y-m-d', $time);
            $date = new DateTime();
            $now = $date->format('Y-m-d');
            if ($now != $bTime) {
                $result = false;
            }
        }
        return $result;
    }

    //////////////////////////////////////////////////
    public function show(Order $order) {
        //
    }

    //////////////////////////////////////////////////
    public function edit(Order $order) {
        $clinics = Clinic::all();
        $states = State::all();
        $cities = City::all();
        return view('pages.order.edit.edit', compact(['clinics', 'order', 'states', 'cities']));
    }

    //////////////////////////////////////////////////
    public function update(Request $request, Order $order): \Illuminate\Http\RedirectResponse {
        $patientId = $request->get('patient_id');
        $identity = $request->get('identity');
        $dob = $request->get('dob');
        $tt = DateTime::createFromFormat('d/m/Y', $dob);
        if ($tt) {
            $request['dob'] = DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d');
        }

        if ($patientId) {
            $patient = Patient::find($patientId);
        } else {
            $patient = Patient::where('identity', $identity)->first();
        }
        if ($patient) {
            $patient->update($request->all());
        }

        $order->update($request->all());
        return redirect()->route('order.index')
                        ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////////
    public function destroy($id): \Illuminate\Http\JsonResponse {
        $order = Order::find($id);
        if ($order) {
            $order->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////
    public function updateStatus(Request $request): \Illuminate\Http\RedirectResponse {
        $save_data = $request->all();
        $id = $request->get('order_id');
        $order = Order::find($id);
        if ($order) {
            if (array_key_exists('pharmacy_payment', $save_data)) {
                $order->update(['pharmacy_payment' => $request->get('pharmacy_payment')]);
            }
            if (array_key_exists('lab_payment', $save_data)) {
                $order->update(['lab_payment' => $request->get('lab_payment')]);
            }
            if (array_key_exists('xray_payment', $save_data)) {
                $order->update(['xray_payment' => $request->get('xray_payment')]);
            }
            if (array_key_exists('status', $save_data)) {
                $order->update(['status' => $request->get('status')]);
            }
            $cUser = Auth::guard()->user();
            $user = new User();
            $receivers = null;
            if ($cUser->role_id == 9) {
                $r1 = 0;
                $r2 = 0;
                $r3 = 0;
                if (sizeof($order->medicines) > 0) {
                    $r1 = 10;
                }
                if (sizeof($order->checkups) > 0) {
                    $r2 = 12;
                }
                if (sizeof($order->xrays) > 0) {
                    $r3 = 13;
                }
                $receivers = $user->getDeskUsers($r1, $r2, $r3);
            }
            if ($cUser->role_id == 10 || $cUser->role_id == 12 || $cUser->role_id == 13) {
                $receivers = $user->getByRole(4);
            }

            if ($receivers) {
                foreach ($receivers as $receiver) {
                    event(new OrderEvent($receiver));
                }
            }

            return redirect()->route('order.index')
                            ->with('success', 'تم الإرسال بنجاح');
        } else {
            return redirect()->route('order.index')
                            ->with('danger', 'حدث خطأ');
        }
    }

    //////////////////////////////////////////////
    public function updateField(Request $request): \Illuminate\Http\RedirectResponse {
        $save_data = $request->all();
        $id = $request->get('order_id');
        $order = Order::find($id);
        if ($order) {
            if (array_key_exists('in_pharmacy', $save_data)) {
                $order->update(['in_pharmacy' => $request->get('in_pharmacy')]);
            }
            if (array_key_exists('in_lab', $save_data)) {
                $order->update(['in_lab' => $request->get('in_lab')]);
            }
            if (array_key_exists('in_xray', $save_data)) {
                $order->update(['in_xray' => $request->get('in_xray')]);
            }
            if (array_key_exists('status', $save_data)) {
                $order->update(['status' => $request->get('status')]);
            }
            return redirect()->route('order.index')
                            ->with('success', 'تم الإرسال بنجاح');
        } else {
            return redirect()->route('order.index')
                            ->with('danger', 'حدث خطأ');
        }
    }

    //////////////////////////////////////////////
    public function status(Request $request): \Illuminate\Http\JsonResponse {
        $id = $request->get('id');
        $info = Order::find($id);
        return updateModelStatus($info);
    }

    //////////////////////////////////////////////
    public function searchPatients(Request $request): \Illuminate\Http\JsonResponse {
        $result = array();
        $identity = $request->get('term');
        $patient = new Patient();
        $info = $patient->searchByIdentity($identity);
        if (sizeof($info) > 0) {
            foreach ($info as $item) {
                $result[] = array(
                    'value' => $item->id,
                    'label' => $item->identity,
                    'name' => $item->name,
                    'mobile' => $item->mobile,
                    'dob' => $item->dob,
                    'countries_id' => $item->countries_id,
                    'states_id' => $item->states_id,
                    'cities_id' => $item->cities_id,
                    'nationality_id' => $item->nationality_id,
                    'gender' => $item->gender,
                    'address' => $item->address,
                );
            }
        }
        return response()->json($result);
    }

    //////////////////////////////////////////////
    public function searchMedicine(Request $request): \Illuminate\Http\JsonResponse {
        $result = array();
        $name = $request->get('term');
        $medicine = new Medicine();
        $info = $medicine->search($name);
        if (sizeof($info) > 0) {
            foreach ($info as $item) {
                $result[] = array(
                    'value' => $item->id,
                    'label' => $item->name,
                    'unit' => $item->unit,
                    'price' => $item->price,
                );
            }
        }
        return response()->json($result);
    }

    //////////////////////////////////////////////
    public function orderTotal(Request $request): int {
        $orderId = $request->get('id');
        $order = Order::find($orderId);
        return $this->getOrderTotal($order);
    }

    //////////////////////////////////////////////
    public function getOrderTotal($order): int {
        $total = 0;
        if ($order->medicines && $order->pharmacy_payment > -1) {
            foreach ($order->medicines as $item) {
                if ($item->status == 1 && $item->payment_status == 1) {
                    $total += $item->net_price * $item->quantity;
                }
            }
        }
//        if ($order->checkups && $order->lab_payment > -1) {
//            foreach ($order->checkups as $item) {
//                if ($item->payment_status == 1) {
//                    $total += $item->checkup->price;
//                }
//            }
//        }
//        if ($order->xrays && $order->xray_payment > -1) {
//            foreach ($order->xrays as $item) {
//                if ($item->payment_status == 1) {
//                    $total += $item->xray->price;
//                }
//            }
//        }
        return $total;
    }

    //////////////////////////////////////////////
    public function addNote(Request $request): \Illuminate\Http\JsonResponse {
        $type = $request->get('type');
        $id = $request->get('id');
        $note = $request->get('note');
        if ($type == 'xray') {
            $info = OrderXray::find($id);
            $update = $info->update(['note' => $note]);
        } else if ($type == 'checkup') {
            $info = OrderCheckup::find($id);
            $update = $info->update(['instructions' => $note]);
        } else {
            return response()->json(array(
                        'success' => false,
                        'message' => 'حدث خطأ'
                            ), 200);
        }

        if ($update) {
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

    //////////////////////////////////////////////
    public function getGovData(Request $request) {
        $identity = $request->get('gov_identity');
        $result = null;
        if ($identity) {
            $curl = curl_init();
            $data_in = array("package" => "MOI_GENERAL_PKG", "procedure" => "CITZN_INFO", "user_id" => $identity);
            $in = array(
                "WB_USER_NAME_IN" => "",
                "WB_USER_PASS_IN" => "",
                "DATA_IN" => $data_in
            );
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://eservices.mtit.gov.ps/ws/gov-services/ws/getData",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($in),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                dd('Error');
                echo "cURL Error #:" . $err;
            } else {
                $result = json_decode($response);
            }
        }
        return $result;
    }

    //////////////////////////////////////////////////
    public function print(Order $order) {
        $nowDate = Carbon::now();
        $date = $nowDate->format('d-m-Y');
        return view('pages.order.index.print', compact(['order', 'date']));
    }

    //////////////////////////////////////////////////
    public function cancel(Request $request) {
        $id = $request->get('id');
        $order = Order::find($id);
        if ($order) {
            $value = $order->cancel;
            if ($value == 0) {
                $order->update(['cancel' => 1]);
                return response()->json(['status' => 'success', 'message' => trans('تم إلغاء الطلب بنجاح.'), 'type' => 'no']);
            } else {
                $order->update(['cancel' => 0]);
                return response()->json(['status' => 'success', 'message' => trans('تم تفعيل الطلب بنجاح.'), 'type' => 'no']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => trans('لم يتم العثور على البيانات!')]);
        }
    }

}
