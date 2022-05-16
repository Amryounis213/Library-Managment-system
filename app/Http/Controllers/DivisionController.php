<?php

namespace App\Http\Controllers;

use App\DataTables\Divisions\DivisionsDataTable;
use App\DataTables\Divisions\TrashedDataTable;
use App\Models\Division;
use App\Models\Kindergarten;
use App\Models\Level;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DivisionsDataTable $datatable)
    {
        return $datatable->render('pages.divisions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kindergartens =Kindergarten::get();
        $levels = Level::get();
        return view('pages.divisions.create' , [
            'kindergartens'=>$kindergartens ,
            'levels'=>$levels,
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
        Division::create($request->all());
        return redirect()->route('divisions.index')->with('success' , 'تمت اضافة الشعبة بنجاح');
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
        $division = Division::find($id);
        $kindergartens =Kindergarten::where('status' , 1)->get();
        $levels = Level::get();
        return view('pages.divisions.edit' , [
            'division'=>$division ,
            'kindergartens'=>$kindergartens ,
            'levels'=>$levels,
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
        $division = Division::find($id);
        $division->update($request->all());
        return redirect()->route('divisions.index')->with('success' , 'تمت تعديل الشعبة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $d = Division::find($id);
        if($d->Children->count() > 0){
            return response()->json(['status' => 'error', 'message' => 'لا يمكن حذف هذه الشعبة لوجود طلاب فيها!']);
        }
        $d->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
       
    }

    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Division::find($id);
        return updateModelStatus($info);
    }


    public function GetTrashed(TrashedDataTable $dataTable)
    {
        return $dataTable->render('pages.divisions.index');
    }


    public function RestoreTrashed($id)
    {
        $children = Division::withTrashed()->where('id' , $id)->first();
        $children->deleted_at = null ;
        $children->save();
        return redirect()->back()->with('success' , 'تم استرجاع الشعبة بنجاح');
    }
}
