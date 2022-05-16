<?php

namespace App\Http\Controllers;

use App\DataTables\InComes\InComesDataTable;
use App\DataTables\InComes\InComeWithChildDataTable;
use App\Models\Income;
use App\Models\IncomeWithChild;
use App\Models\Year;
use Illuminate\Http\Request;

class InComeWithChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InComeWithChildDataTable $datatable)
    {
        return $datatable->render('pages.incomewithchildren.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $years= Year::get();
        $incomes =Income::where('with_child' , 1)->get();
      return view('pages.incomewithchildren.create',compact('years' , 'incomes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        IncomeWithChild::create($request->all());
        return redirect()->route('incomesiwithchild.index')->with('success', 'تم اضافة ايراد جديد');
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
        $income = IncomeWithChild::find($id);
        $years= Year::get();
        $incomes =Income::where('with_child' , 1)->get();
        return view('pages.incomewithchildren.edit' ,compact('income' , 'incomes' , 'years'));
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
        $IncomeWithChild = IncomeWithChild::find($id);
        $IncomeWithChild->update($request->all());
        return redirect()->route('incomesiwithchild.index')->with('success', 'تم تعديل الايراد بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $IncomeWithChild = IncomeWithChild::find($id);
        $IncomeWithChild->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }


   

   

}
