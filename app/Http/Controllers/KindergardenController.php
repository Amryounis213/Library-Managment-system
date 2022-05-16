<?php

namespace App\Http\Controllers;

use App\DataTables\Kindergarten\KindergartenDataTable;
use App\Models\Kindergarten;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KindergardenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(KindergartenDataTable $dataTable)
    {
        return $dataTable->render('pages.kindergartens.index');
    }

    //////////////////////////////////////////////////
    public function create()
    {
       
        return view('pages.kindergartens.create');
    }

//////////////////////////////////////////////////
    public function store(Request $request)
    {
        
        
        $Kindergarten =Kindergarten::create($request->all());

        return redirect()->route('kindergarden.index')
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
    public function edit($id)
    {
        $kindergarden = Kindergarten::find($id);
        return view('pages.kindergartens.edit',  ['kindergarden'=>$kindergarden]);
    }

    //////////////////////////////////////////////////
    public function update(Request $request, $id)
    {
        $kindergarden = Kindergarten::find($id);
        $kindergarden->update($request->all());

        return redirect()->route('kindergarden.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////////
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        $patient = Kindergarten::find($id);
        // if ($patient) {
           
        //         return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف ملف المريض لوجود طلبات فعالة!']);
        //     }
        $patient->delete();
       
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }

    //////////////////////////////////////////////
    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Kindergarten::find($id);
        return updateModelStatus($info);
    }
}
