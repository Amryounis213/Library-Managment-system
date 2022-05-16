<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubSection;
use App\Models\SubSubSection;
use Illuminate\Http\Request;

class AllSectionActionController extends Controller
{
    
    public function getsubsection($id)
    {
        $sub = SubSection::where('section_id' , $id)->get();
        return response()->json([
            'status'=>true , 
            'code'=> 200 ,
            'message'=> 'تم ارجاع كل البيانات' ,
            'sub'=> $sub,
        ]);
    }


    public function getSubSub($id)
    {
        $sub = SubSubSection::where('sub_section_id' , $id)->get();
        return response()->json([
            'status'=>true , 
            'code'=> 200 ,
            'message'=> 'تم ارجاع كل البيانات' ,
            'sub'=> $sub,
        ]);
    }

    // public function getSubSubSub($id)
    // {
    //     $sub = SubSubSubSection::where('sub_sub_section_id' , $id)->get();
    //     return response()->json([
    //         'status'=>true , 
    //         'code'=> 200 ,
    //         'message'=> 'تم ارجاع كل البيانات' ,
    //         'sub'=> $sub,
    //     ]);
    // }

    // public function Result()
    // {
        
    // }

    
}
