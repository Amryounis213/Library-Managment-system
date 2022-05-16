<?php

namespace App\Http\Controllers;

use App\DataTables\Subscriptions\YearSubscriptionsDataTable;
use App\Models\Subscriptions;
use App\Models\YearSubscriptions;
use Illuminate\Http\Request;

class YearSubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(YearSubscriptionsDataTable $datatable)
    {
        return $datatable->render('pages.yearsubscriptions.index');
    }

   
    public function create()
    {
        $subs = Subscriptions::select('id' , 'name')->where('status' , 1)->get();
        return view('pages.yearsubscriptions.create' ,compact('subs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        YearSubscriptions::create($request->all());

        return redirect()->route('year-sub.index')->with('succss' , 'تم اضافة اشتراك سنوي جديد');
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
        $sub = YearSubscriptions::find($id);
        $subs = Subscriptions::select('id' , 'name')->where('status' , 1)->get();

        return view('pages.yearsubscriptions.edit' , compact('sub' , 'subs'));
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
        $sub = YearSubscriptions::find($id);
        $sub->update($request->all());
        return redirect()->route('year-sub.index')->with('success' , 'تم تعديل الاشتراك السنوي بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = YearSubscriptions::find($id);
        $sub->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }


    public function updateStaticFee(Request $request)
    {
       
        $sub = YearSubscriptions::find($request->id);
        $sub->update([
            'static_fee'=> $sub->static_fee ? 0 : 1 , 
        ]);
        return response()->json(['status' => 'success', 'message' => trans('تم تعديل الحالة بنجاح.'), 'type' => 'no']);

    }
}
