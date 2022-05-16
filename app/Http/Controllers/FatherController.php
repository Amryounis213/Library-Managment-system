<?php

namespace App\Http\Controllers;

use App\DataTables\Fathers\FathersDataTable;
use App\DataTables\Fathers\TrashedDataTable;
use App\Models\Father;
use Illuminate\Http\Request;

class FatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FathersDataTable $datatable)
    {
        return $datatable->render('pages.fathers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.fathers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Father::create($request->all());
        return redirect()->route('fathers.index')->with('success' , 'تمت الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $father = Father::find($id);
        return view('pages.fathers.edit' , compact('father'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $father = Father::find($id);
        $father->update($request->all());
        return redirect()->route('fathers.index')->with('success' , 'تم التعديل بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $father = Father::find($id);
        if($father->Children->count() > 0)
        {
            return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف ولي الامر لان لديه ابناء']);

        }
        $father->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }

    public function GetTrashed(TrashedDataTable $dataTable)
    {
       
        return $dataTable->render('pages.employees.index.index');
    }


    public function RestoreTrashed($id)
    {
        $children = Father::withTrashed()->where('id' , $id)->first();
        $children->deleted_at = null ;
        $children->save();
        return redirect()->back()->with('success' , 'تم استرجاع الطالب بنجاح');
    }
}
