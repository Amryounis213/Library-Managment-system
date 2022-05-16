<?php

namespace App\Http\Controllers;

use App\DataTables\Checkups\CheckupsDataTable;
use App\Models\Checkup;
use Illuminate\Http\Request;

class CheckupsController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:checkups.show')->only(['index', 'show']);
        $this->middleware('permission:checkups.create')->only(['create', 'store']);
        $this->middleware('permission:checkups.edit')->only(['edit', 'update', 'status']);
        $this->middleware('permission:checkups.delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CheckupsDataTable $dataTable)
    {
        return $dataTable->render('pages.checkup.index.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = '';
        return view('pages.checkup.create.create', compact('info'));
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
        Checkup::create(array_merge($request->all(), ['code' => $code]));

        return redirect()->route('checkup.index')
            ->with('success', 'تمت الإضافة بنجاح.');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Checkup $checkup
     * @return \Illuminate\Http\Response
     */
    public function show(Checkup $checkup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Checkup $checkup
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkup $checkup)
    {
        return view('pages.checkup.edit.edit', compact('checkup'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Checkup $checkup
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Checkup $checkup)
    {
        $checkup->update($request->all());

        return redirect()->route('checkup.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $checkup = Checkup::find($id);
        if ($checkup) {
            if (sizeof($checkup->orders) > 0) {
                return response()->json(['status' => 'error', 'message' => 'لا يمكن الحذف لوجود طلبات مرتبطه به!']);
            }
            $checkup->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////
    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Checkup::find($id);
        return updateModelStatus($info);
    }
}
