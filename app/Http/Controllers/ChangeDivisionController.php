<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
use App\Models\JobPlacement;
use App\Models\Level;
use App\Models\Period;
use Auth;
use Illuminate\Http\Request;

class ChangeDivisionController extends Controller
{
    public function switchDivision(Request $request)
    {
       
        $division1 = $request->division1 ;
        $division2 = $request->division2 ;
       
        $teacher1 = $request->teacher1 ;
        $teacher2 = $request->teacher2 ;

        $level1 = $request->level1 ;
        $level2 = $request->level2 ;


        /** التبديل  */
        $job_placment1 = JobPlacement::where('employee_id' , $teacher1)->first();
        $job_placment1->division_id = $division2 ;
        $job_placment1->level_id = $level2 ;

        $kindergarten1 = $job_placment1->kindergarten_id ;
        


        $job_placment2 = JobPlacement::where('employee_id' , $teacher2)->first();
        $job_placment2->division_id = $division1 ;
        $job_placment2->level_id = $level1 ;

        $kindergarten2 = $job_placment2->kindergarten_id ;

    
        $job_placment1->kindergarten_id = $kindergarten2;
        $job_placment2->kindergarten_id = $kindergarten1;




        $job_placment1->save();
        $job_placment2->save();


        
       

        return redirect()->back()->with('success' , 'تم تبديل الشعب بين المربيات بنجاح');  
    }

    public function index()
    {
         /**
         * ========================================
         * Variable If the The SuperAdmin Authintaction
         * ========================================
         */
        //#1
        $employees = Employee::whereHas('JobPlacement' , function($query){
            $query->whereNotNull('division_id') ;
        })->get();
        //#2
        $divisions = Division::where('status' , 1)->get();
        $periods = Period::where('status' , 1)->get();
        //#3
        $levels = Level::where('status' , 1)->get();

        /**
         * ========================================
         * Variable If the The Manger Authintaction
         * ========================================
         */
        if(Auth::user()->kindergarten_id != null)
        {
            $employees = Employee::whereHas('JobPlacement' , function($query){
                $query->whereNotNull('division_id')
                ->where('kindergarten_id' , Auth::user()->kindergarten_id);
            })->get();
            //#2
            $divisions = Division::where('kindergarten_id' , Auth::user()->kindergarten_id)->where('status' , 1)->get();
        }

        /**
         * End
         */

        return view('pages.SwitchDivisions.employees.create' , [
            'employees'=> $employees ,
            'divisions'=> $divisions ,
            'levels'=>$levels ,
            'periods'=>$periods ,
        ]);


        
    }
}
