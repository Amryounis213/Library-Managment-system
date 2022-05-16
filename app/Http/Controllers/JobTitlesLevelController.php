<?php

namespace App\Http\Controllers;

use App\DataTables\SystemConstants\JobTitlesDataTable;
use App\Models\JobTitles;
use App\Models\Titles;
use Illuminate\Http\Request;

class JobTitlesLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobTitlesDataTable $dataTable)
    {
       return  $dataTable->render('pages.SystemConstants.JobTitles.index');

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.SystemConstants.JobTitles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Titles::create($request->all());
        return response()->json([
            'status' => 'success',
             'message' => 'تم اضافة خيار بنجاح' ,
             'data'=> $data,
            ]);
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
        $educational = JobTitles::find($id);
        return view('pages.SystemConstants.JobTitles.edit' , compact('educational'));


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
        $educational = JobTitles::find($id);
        $educational->update($request->all());
        return redirect()->route('job-titles.index')->with('success' , 'تم الاضافة بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $educational = JobTitles::find($id);
        $educational->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }
}
