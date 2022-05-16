<?php

namespace App\Http\Controllers;

use App\DataTables\SystemConstants\FatherJobDataTable;
use App\Models\FatherJobs;
use Illuminate\Http\Request;

class FatherJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FatherJobDataTable $dataTable)
    {
       return  $dataTable->render('pages.SystemConstants.FatherJobs.index');

       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.SystemConstants.FatherJobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        FatherJobs::create($request->all());
        return redirect()->route('father-jobs.index')->with('success' , 'تم الاضافة بنجاح');
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
        $educational = FatherJobs::find($id);
        return view('pages.SystemConstants.FatherJobs.edit' , compact('educational'));


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
        $educational = FatherJobs::find($id);
        $educational->update($request->all());
        return redirect()->route('father-jobs.index')->with('success' , 'تم الاضافة بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $educational = FatherJobs::find($id);
        $educational->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }
}
