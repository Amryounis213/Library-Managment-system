<?php

namespace App\Http\Controllers;

use App\DataTables\Expenses\ExpensesPaymentDataTable;
use App\Models\Expense;
use App\Models\ExpensePay;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExpensesPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpensesPaymentDataTable $datatable)
    {
        $expenses=Expense::select('id','name')->get();
        $years =Year::select('id','name')->get();
        return $datatable->render('pages.expense-pay.index' , compact('expenses' , 'years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub = ExpensePay::create($request->all());
        return response()->json(['status' => 'success', 'message' => trans('تم تسديد مصروف جديد ')]);
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
        //
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
        $sub = ExpensePay::find($id);
        $sub->update($request->all());
        return response()->json(['status' => 'success', 'message' => trans('تم تسديد مصروف جديد ')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = ExpensePay::find($id);
        $sub->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    public function print($id) {
       $order = ExpensePay::find($id);
       $nowDate = Carbon::now();
       $date = $nowDate->format('d-m-Y');
       return view('pages.expense-pay.collections.print', compact(['order', 'date']));
   }
}
