<?php

namespace App\Http\Controllers;

use App\DataTables\Patients\PatientsDataTable;
use App\Models\City;
use App\Models\Order;
use App\Models\Patient;
use App\Models\State;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:patients.show')->only(['index', 'show']);
        $this->middleware('permission:patients.create')->only(['create', 'store']);
        $this->middleware('permission:patients.edit')->only(['edit', 'update', 'status']);
        $this->middleware('permission:patients.delete')->only(['destroy']);
    }

    //////////////////////////////////////////////////
    public function index(PatientsDataTable $dataTable)
    {
        return $dataTable->render('pages.patient.index');
    }

    //////////////////////////////////////////////////
    public function create()
    {
        $states = State::all();
        $cities = City::all();
        return view('pages.patient.create', compact('states', 'cities'));
    }

//////////////////////////////////////////////////
    public function store(Request $request)
    {
        $identity = $request->get('identity');
        $patient = Patient::where('identity', $identity)->first();
        if ($patient) {
            $request->session()->flash('danger', 'رقم الهوية موجود مسبقاً!');
            return redirect(route('patient.create'))->withInput();
        }
        $request['created_by'] = Auth::guard()->user()->id;
        $dob = $request->get('dob');
        $tt = DateTime::createFromFormat('d/m/Y', $dob);
        if ($tt) {
            $request['dob'] = DateTime::createFromFormat('d/m/Y', $dob)->format('Y-m-d');
        }
        Patient::create(array_merge($request->all()));

        return redirect()->route('patient.index')
            ->with('success', 'تمت الإضافة بنجاح.');

    }

    //////////////////////////////////////////////////
    public function show(Patient $patient)
    {
        $orders = $patient->orders;
//        dd($orders);
        return view('pages.patient.show', compact('patient', 'orders', 'patient'));
    }

    //////////////////////////////////////////////////
    public function edit(Patient $patient)
    {
        $states = State::all();
        $cities = City::all();
        return view('pages.patient.edit', compact('patient', 'states', 'cities'));
    }

    //////////////////////////////////////////////////
    public function update(Request $request, Patient $patient)
    {
        $patient->update($request->all());

        return redirect()->route('patient.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////////
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $patient = Patient::find($id);
        if ($patient) {
            if (sizeof($patient->orders) > 0) {
                return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف ملف المريض لوجود طلبات فعالة!']);
            }
            $patient->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }

    //////////////////////////////////////////////
    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Patient::find($id);
        return updateModelStatus($info);
    }
}
