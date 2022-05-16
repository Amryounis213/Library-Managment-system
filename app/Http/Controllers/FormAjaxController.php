<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\ClassPlacment;
use App\Models\Discount;
use App\Models\Division;
use App\Models\Employee;
use App\Models\IncomesRevenue;
use App\Models\JobPlacement;
use App\Models\Section;
use App\Models\Subscriptions;
use App\Models\SubSection;
use App\Models\Titles;
use Auth;
use Illuminate\Http\Request;

class FormAjaxController extends Controller
{
    public function GetDivisionByLevel($id , $kinder)
    {
        if(Auth::user()->kindergarten_id != null)
        {
            $divisions = Division::where('level_id', $id)->where('kindergarten_id' , Auth::user()->kindergarten_id)->get();

        }
        else{
            $divisions = Division::where('level_id', $id)->where('kindergarten_id' , $kinder)->get();
        }
        return response()->json($divisions);
    }

    public function GetDataByTitles($id)
    {
        $sections = Section::where('title_id' , $id)->get();
        return response()->json($sections);
    }

    public function GetDataBySections($id)
    {
        $sections = SubSection::where('section_id' , $id)->get();
        return response()->json($sections);
    }



    public function GetEmployeeData($id)
    {
        $emp = JobPlacement::with(['Period' , 'Division' , 'Level'])->where('employee_id' , $id)->first();
       
        return response()->json($emp);
    }





}
