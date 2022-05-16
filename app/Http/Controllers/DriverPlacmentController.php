<?php

namespace App\Http\Controllers;

use App\DataTables\Drivers\DriverPlacmentDataTable;
use App\Models\Driver;
use App\Models\DriverPlacment;
use App\Models\Kindergarten;
use App\Models\Period;
use App\Models\Trips;
use Illuminate\Http\Request;

class DriverPlacmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DriverPlacmentDataTable $datatable)
    {
        return $datatable->render('pages.drivers.driver_placement.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $trips  = Trips::where('status', 1)->get();
        $periods = Period::select('id', 'name')->get();
        $drivers = Driver::select('id', 'name')->get();
        return view('pages.drivers.driver_placement.create', [
            'trips' => $trips,
            'periods' => $periods,
            'drivers' => $drivers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $driver_placment = DriverPlacment::create($request->all());
        return redirect()->route('driverplacment.index')->with('success', 'تم  التسكين بنجاح');
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

        $driver_placment = DriverPlacment::find($id);
        $trips = Trips::where('status', 1)->get();
        $periods = Period::select('id', 'name')->get();
        $drivers = Driver::select('id', 'name')->get();
        return view('pages.drivers.driver_placement.edit', [
            'trips' => $trips,
            'periods' => $periods,
            'drivers' => $drivers,
            'driver_placment'=>$driver_placment ,
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
        $driver_placment = DriverPlacment::find($id);
        $driver_placment->update($request->all());
        return redirect()->route('driverplacment.index')->with('success', 'تم تعديل التسكين بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $info = DriverPlacment::find($id);
        $info->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }


    
}
