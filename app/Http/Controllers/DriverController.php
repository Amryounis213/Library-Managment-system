<?php

namespace App\Http\Controllers;

use App\DataTables\Drivers\DriversDataTable;
use App\DataTables\Drivers\TrashedDataTable;
use App\Models\Driver;
use App\Models\Kindergarten;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DriversDataTable $datatable)
    {
        $visable = 'no';
        return $datatable->render('pages.drivers.index' , compact('visable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kinder = Kindergarten::select('id' , 'name')->where('status' , 1)->get();
        return view('pages.drivers.create' , ['kindergartens'=>$kinder]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        Driver::create($request->all());
        return redirect()->route('drivers.index')->with('success' , 'تمت اضافة السائق بنجاح');
        
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
        $driver = Driver::find($id);
        $kinder = Kindergarten::select('id' , 'name')->where('status' , 1)->get();
        return view('pages.drivers.edit' , [
            'kindergartens'=>$kinder , 
            'driver'=>$driver ,
        ]);
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
        $driver = Driver::find($id);
        $driver->update($request->all());

        return redirect()->route('drivers.index')->with('success' , 'تم تعديل السائق بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $info = Driver::find($id);
        $info->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }
    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Driver::find($id);
        return updateModelStatus($info);
    }


    public function GetTrashed(TrashedDataTable $dataTable)
    {
        $visable = 'no';
        return $dataTable->render('pages.drivers.index' , compact('visable'));
    }


    public function RestoreTrashed($id)
    {
        $children = Driver::withTrashed()->where('id' , $id)->first();
        $children->deleted_at = null ;
        $children->save();
        return redirect()->back()->with('success' , 'تم استرجاع الطالب بنجاح');
    }

   

    
    

    
}
