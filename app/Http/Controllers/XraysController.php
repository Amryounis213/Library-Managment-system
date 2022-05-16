<?php

namespace App\Http\Controllers;

use App\DataTables\Xrays\XraysDataTable;
use App\Models\Xray;
use Illuminate\Http\Request;

class XraysController extends Controller
{
    /**
     * Instantiate a new PostController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:xrays.show')->only(['index', 'show']);
        $this->middleware('permission:xrays.create')->only(['create', 'store']);
        $this->middleware('permission:xrays.edit')->only(['edit', 'update', 'status']);
        $this->middleware('permission:xrays.delete')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(XraysDataTable $dataTable)
    {
        return $dataTable->render('pages.xray.index.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $info = '';
        return view('pages.xray.create.create', compact('info'));
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
        Xray::create(array_merge($request->all(), ['code' => $code]));

        return redirect()->route('xray.index')
            ->with('success', 'تمت الإضافة بنجاح.');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Xray $xray
     * @return \Illuminate\Http\Response
     */
    public function show(Xray $xray)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Xray $xray
     * @return \Illuminate\Http\Response
     */
    public function edit(Xray $xray)
    {
        return view('pages.xray.edit.edit', compact('xray'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Xray $xray
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Xray $xray)
    {
        $xray->update($request->all());

        return redirect()->route('xray.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    //////////////////////////////////////////////
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $xray = Xray::find($id);
        if ($xray) {
            if (sizeof($xray->orders) > 0) {
                return response()->json(['status' => 'error', 'message' => 'لا يمكن الحذف لوجود طلبات مرتبطه به!']);
            }
            $xray->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'تم الحذف بنجاح']);
    }

    //////////////////////////////////////////////
    public function status(Request $request)
    {
        $id = $request->get('id');
        $info = Xray::find($id);
        return updateModelStatus($info);
    }
}
