<?php

namespace App\Http\Controllers;

use App\DataTables\Subscriptions\ChildrenSubscriptionsDataTable;
use App\Models\Children;
use App\Models\ChildrenSubscriptions;
use App\Models\Discount;
use App\Models\Subscriptions;
use App\Models\Year;
use App\Models\YearSubscriptions;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChildrenSubscriptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ChildrenSubscriptionsDataTable $datatable)
    {
        
        if(Auth::user()->kindergarten_id != null)
        {
            $childrens = Children::whereHas('ClassPlacement' , function($query){
                $query->where('kindergarten_id' , Auth::user()->kindergarten_id);
            })->select('id', 'name')->where('status', 1)->get();

        }else{
            $childrens = Children::select('id', 'name')->where('status', 1)->get();

        }

        $subs = Subscriptions::whereHas('YearSubscription')->where('status', 1)->get();
        $dicsounts = Discount::get();
        $years = Year::where('status', 1)->get();

        return $datatable->render('pages.childrensubscriptions.index', compact('childrens', 'subs', 'dicsounts', 'years'));
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

        $exists = ChildrenSubscriptions::where('children_id', $request->children_id)
        ->where('subscription_id', $request->subscription_id)
        ->where('year' , $request->year)
        ->exists();
        if (!$exists) {
            $requiredAmount = Subscriptions::find($request->subscription_id)->YearSubscription->price;
            $disountAmount = $requiredAmount * $request->discount / 100;
            $total = $requiredAmount - $disountAmount;
            $request->merge([
                'required_amount' => $requiredAmount,
                'total' => $total,
            ]);
            $sub = ChildrenSubscriptions::create($request->all());
            return response()->json(['status' => 'success', 'message' => trans('تم اضافة اشتراك جديد للطفل')]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'هذا الاشتراك موجود للطالب']);
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
        $sub = ChildrenSubscriptions::find($id);
        $subs = Subscriptions::whereHas('YearSubscription')->where('id' , $sub->subscription_id)->where('status', 1)->get();
        $childrens = Children::select('id', 'name')->where('status', 1)->where('id', $sub->children_id)->get();
        $discounts = Discount::get();
        $years = Year::where('status', 1)->get();
        return view('pages.childrensubscriptions.edit', [
            'sub' => $sub,
            'subs' => $subs,
            'childrens' => $childrens,
            'dicsounts' => $discounts,
            'years' => $years,
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
       // return $request->discount_amount;
        $CS = ChildrenSubscriptions::find($id);
        $requiredAmount = Subscriptions::find($request->subscription_id)->YearSubscription->price;
      //  $disountAmount = $requiredAmount * $request->discount / 100;
        $total = $requiredAmount - $request->discount_amount;
       
        $request->merge([
            'required_amount' => $requiredAmount,
            'total' => $total,
        ]);
        $CS->update($request->all());
        return redirect()->route('children-subscriptions.index')->with( 'success' , 'تم تعديل اشتراك الطفل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = ChildrenSubscriptions::find($id);
        $sub->delete();
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }
}
