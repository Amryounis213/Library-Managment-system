<?php

namespace App\Http\Controllers;

use App\DataTables\SystemConstants\MajorsDataTable;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MajorsDataTable $dataTable)
    {
       return  $dataTable->render('pages.SystemConstants.Majors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.SystemConstants.Majors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Major::create($request->all());
        return redirect()->route('majors.index')->with('success' , 'تم الاضافة بنجاح');
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
        $educational = Major::find($id);
        return view('pages.SystemConstants.Majors.edit' , compact('educational'));


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
        $educational = Major::find($id);
        $educational->update($request->all());
        return redirect()->route('majors.index')->with('success' , 'تم الاضافة بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $educational = Major::find($id);
        $educational->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }
}
