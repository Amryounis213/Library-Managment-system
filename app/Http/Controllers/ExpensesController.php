<?php

namespace App\Http\Controllers;

use App\DataTables\Expenses\ExpensesDataTable;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ExpensesDataTable $datatable)
    {
        return $datatable->render('pages.expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.expenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Expense::create($request->all());
        return redirect()->route('expenses.index')->with('success' , 'تمت اضافة المصروف بنجاح');
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
        $expense =Expense::find($id);
        return view('pages.expenses.edit' , compact('expense'));
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
        $expense =Expense::find($id);
        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success' , 'تم تعديل المصروف بنجاح');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense =Expense::find($id);
        $expense->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);

    }
    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Expense::find($id);
        return updateModelStatus($info);
    }
}
