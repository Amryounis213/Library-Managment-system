<?php

namespace App\Http\Controllers;

use App\DataTables\Clinics\ClinicsDataTable;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:clinics.show')->only(['index', 'show']);
        $this->middleware('permission:clinics.create')->only(['create', 'store']);
        $this->middleware('permission:clinics.edit')->only(['edit', 'update', 'status']);
        $this->middleware('permission:clinics.delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClinicsDataTable $dataTable)
    {
        return $dataTable->render('pages.clinic.index.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = '';
        return view('pages.clinic.create.create', compact('info'));
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
        Clinic::create(array_merge($request->all(), ['code' => $code]));

        return redirect()->route('clinic.index')
            ->with('success', 'تمت الإضافة بنجاح.');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Clinic $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
        return view('pages.clinic.edit.edit', compact('clinic'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Clinic $clinic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Clinic $clinic)
    {
        $clinic->update($request->all());

        return redirect()->route('clinic.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////
    public function destroy($id)
    {
        $clinic = Clinic::find($id);
        if ($clinic) {
            if (sizeof($clinic->orders) > 0) {
                return response()->json(['status' => 'error', 'message' => 'لا يمكن الحذف لوجود طلبات مرتبطه به!']);
            }
            $clinic->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////
    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Clinic::find($id);
        return updateModelStatus($info);
    }
}
