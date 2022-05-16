<?php

namespace App\Http\Controllers;

use App\DataTables\InComes\InComesDataTable;
use App\Models\Income;
use App\Models\Year;
use Illuminate\Http\Request;

class InComeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InComesDataTable $datatable)
    {
        return $datatable->render('pages.incomes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
      return view('pages.incomes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Income::create($request->all());
        return redirect()->route('incomes.index')->with('success', 'تم اضافة ايراد جديد');
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
        $income = Income::find($id);
        return view('pages.incomes.edit' ,compact('income'));
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
        $income = Income::find($id);
        $income->update($request->all());
        return redirect()->route('incomes.index')->with('success', 'تم تعديل الايراد بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $income = Income::find($id);
        $income->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }


    public function status(Request $request)
    {
        $id = $request->get('id');
        $income = Income::find($id);
        return updateModelStatus($income);
    }

    public function withChildstatus(Request $request)
    {
        $id = $request->get('id');
        $income = Income::find($id);
        if($income->with_child)
        {   
            $income->with_child = false ; 
        }else{
            $income->with_child = true ; 
        }
        return updateModelStatus($income);

    }

}
