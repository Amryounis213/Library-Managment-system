<?php

namespace App\Http\Controllers;

use App\DataTables\Attendance\AttendanceDataTable;
use App\Models\Children;
use App\Models\ChildrenAttendances;
use App\Models\Division;
use Auth;
use Illuminate\Http\Request;

class ChildrenAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Children $children)
    {
        
        if(Auth::user()->kindergarten_id != null)
        {
            $childrens = $children->whereHas('ClassPlacement')->where('kindergarten_id' , Auth::user()->kindergarten_id)->get();
            $division = Division::where('kindergarten_id' , Auth::user()->kindergarten_id)->get();
        }
        else{
            $childrens = $children->whereHas('ClassPlacement')->get();
            $division = Division::get();
        }
        // return $childrens;
        return view('pages.Attendance.childrens.index' , [
            
             'model'=>$children,
             'childrens'=>$childrens,
             'division'=>$division,
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
         try {
            
            
            foreach ($request->attendences as $employeeid => $attendence) {


                $child = Children::find($employeeid);

                if( $attendence == 1 ) {
                    $attendence_status = true;
                } else if( $attendence == 2 ){
                    $attendence_status = false;
                }
              
                ChildrenAttendances::create([
                    'children_id'=> $employeeid,
                    'kindergarten_id'=> $child->ClassPlacement->kindergarten_id ,
                    'division_id'=> $child->ClassPlacement->division_id , 
                    'attendence_date'=> date('Y-m-d'),
                    'attendence_status'=> $attendence_status,
                    'period_id'=> $child->ClassPlacement->Period->id,
                ]);
                

            }
            
            return redirect()->route('cattendance.index')->with('success' , 'تم تسجيل الحضور بنجاح');

        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
        //
    }

    /**
     * البحث عن طريق الشعبة الدراسية 
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function DivisionFilterSearch(Request $request , AttendanceDataTable $datatable ,Children $children)
    {
      //  dd($request->division_id);
        if(Auth::user()->kindergarten_id != null)
        {
            $childrens = $children->whereHas('ClassPlacement' , function($query) use($request){
                $query->where('division_id' ,$request->division_id);
            })->orderBy('name')->get();
            $division = Division::where('kindergarten_id' , Auth::user()->kindergarten_id)->get();
        }
        else{

            $childrens = $children->whereHas('ClassPlacement' , function($query) use($request){
                $query->where('division_id' ,$request->division_id);
            })->orderBy('name')->get();
           

            $division = Division::get();
        }

        return view('pages.Attendance.childrens.index' , [
            'dataTable'=>$datatable ,
             'model'=>$children,
             'childrens'=>$childrens,
             'division'=>$division,
             'selected'=> $request->division_id ,
            ]);

    }


    public function autocomplete(Request $request)
    {
        $query = $request->get('terms');
        $data = Children::whereHas('ClassPlacement')->where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($data);
    }

}
