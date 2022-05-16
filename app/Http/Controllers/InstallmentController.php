<?php

namespace App\Http\Controllers;

use App\DataTables\Installments\InstallmentDataTable;
use App\Models\Children;
use App\Models\Installment;
use App\Models\Year;
use Arr;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InstallmentDataTable $datatable)
    {
         
        if(Auth::user()->kindergarten_id != null)
        {
            $childrens = Children::select('id', 'name')->whereHas('ClassPlacement' , function($query){
                $query->where('kindergarten_id' , Auth::user()->kindergarten_id);
            })->where('status', 1)->get();
            
        }else{
            $childrens = Children::select('id', 'name')->whereHas('ClassPlacement')->where('status', 1)->get();
        }

        $years = Year::where('status' , 1)->get();
       return $datatable->render('pages.installments.index' , compact('childrens' , 'years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $start_date = $request->start_date;
        $count_of_installment =$request->no_of_installment ;
        $x = Carbon::parse($start_date)->format('m');
        
        $dd = Carbon::parse($start_date)->format('d');
        $yy = Carbon::parse($start_date)->format('Y');
        $month = [ '09', '10', '11', '12',  '01', '02', '03', '04'];


       
        
        if($count_of_installment == 8)
        {
            $y = 0 ;
        }
        else{
            $y = array_search($x, $month);
        }

        for ($i = 0; $i < $count_of_installment; $i++) {
           
            $ins = new Installment();
            $ins->number = $i + 1;
            if($y != null)
            {
                $m = $month[$y + $i] ?? null ;
               
                if($m){
                    $ins->payment_date = $yy . '-' . $m . '-' . $dd;
                }
                else{
                    $m =$month[($y + $i) - 8] ;
                    $ins->payment_date = $yy . '-' . $m . '-' . $dd;
                }
            }
            else{
                $ins->payment_date = $yy . '-' . $month[$i] . '-' . $dd;
 
            }
            $ins->payment_amount = $request->get('payment_amount') / $count_of_installment ;
            $ins->children_id = $request->get('children_id');
            $ins->notices = $request->get('notices');
            $ins->year = $request->get('year');
            $ins->save();


        }

        return response()->json(['status' => 'success', 'message' => trans('تم جدولة الاقساط بنجاح')]);

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function PayInstallment($id)
    {
        $ins =Installment::find($id);
        $ins->status = 'paid';
        $ins->paid_amount = $ins->payment_amount;
        $ins->save();
        return response()->json([
            'status' => 'success',
             'message' => trans('تم دفع القسط بنجاح') ,
             'children_id' =>$ins->children_id ,
            ]);
    }
}
