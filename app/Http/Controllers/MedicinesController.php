<?php

namespace App\Http\Controllers;

use App\DataTables\Medicines\MedicinesDataTable;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicinesController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:medicines.show')->only(['index', 'show']);
        $this->middleware('permission:medicines.create')->only(['create', 'store']);
        $this->middleware('permission:medicines.edit')->only(['edit', 'update', 'status']);
        $this->middleware('permission:medicines.delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MedicinesDataTable $dataTable)
    {
        return $dataTable->render('pages.medicine.index.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = '';
        return view('pages.medicine.create.create', compact('info'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $code = random_int(100000, 999999);
        $userId = Auth::guard()->user()->id;
        Medicine::create(array_merge($request->all(), ['code' => $code, 'created_by' => $userId]));

        return redirect()->route('medicine.index')
            ->with('success', 'تمت الإضافة بنجاح.');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(Medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Medicine $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        return view('pages.medicine.edit.edit', compact('medicine'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Medicine $medicine
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Medicine $medicine)
    {
        $medicine->update($request->all());

        return redirect()->route('medicine.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////
    public function destroy($id)
    {
        $medicine = Medicine::find($id);
        if ($medicine) {
            if (sizeof($medicine->orders) > 0) {
                return response()->json(['status' => 'error', 'message' => 'لا يمكن الحذف لوجود طلبات مرتبطه به!']);
            }
            $medicine->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////
    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Medicine::find($id);
        return updateModelStatus($info);
    }
}
