<?php

namespace App\Http\Controllers;

use App\DataTables\SystemConstants\EducationalLevelDataTable;
use App\Models\EducationalLevels;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class EducationalLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EducationalLevelDataTable $dataTable)
    {
       return  $dataTable->render('pages.SystemConstants.EducationalLevel.index');

       //return view('pages.SystemConstants.EducationalLevel.index')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.SystemConstants.EducationalLevel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EducationalLevels::create($request->all());
        return redirect()->route('educational-level.index')->with('success' , 'تم الاضافة بنجاح');
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
        $educational = EducationalLevels::find($id);
        return view('pages.SystemConstants.EducationalLevel.edit' , compact('educational'));


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
        $educational = EducationalLevels::find($id);
        $educational->update($request->all());
        return redirect()->route('educational-level.index')->with('success' , 'تم الاضافة بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $educational = EducationalLevels::find($id);
        $educational->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }
}
