<?php

namespace App\Http\Controllers;

use App\DataTables\Subscriptions\SubscriptionsDataTable;
use App\Models\Subscriptions;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SubscriptionsDataTable $datatable)
    {
        return $datatable->render('pages.subscriptions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.subscriptions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Subscriptions::create($request->all());
        return redirect()->route('subscriptions.index')->with('success' , 'تم اضافة الاشتراك بنجاح');

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

        $sub = Subscriptions::find($id);
        return view('pages.subscriptions.edit' , compact('sub'));

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
        $sub = Subscriptions::find($id);
        $sub->update($request->all());
        return redirect()->route('subscriptions.index')->with('success' , 'تم تعديل الاشتراك بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = Subscriptions::find($id);
        $sub->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Subscriptions::find($id);
        return updateModelStatus($info);
    }
}
