<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PurchaseRequestController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'minta_manage')) {
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if (!check_user_access(Session::get('user_access'), 'minta_manage')) {
            return redirect('/');
        }

        $data = PurchaseRequest::all();
        return view('minta.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_user_access(Session::get('user_access'), 'minta_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        $users = User::all();
        return view('minta.minta', compact('data', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'minta_create')) {
            return redirect('/');
        }

        $purchaseRequest = new PurchaseRequest();
        $purchaseRequest->created_id = Auth::user()->id;
        $purchaseRequest->updated_id = Auth::user()->id;
        $purchaseRequest->no_faktur = $request->no_faktur;
        $purchaseRequest->id_user_pemohon = $request->id_user_pemohon;
        $purchaseRequest->id_user_menyetujui = $request->id_user_menyetujui;
        $purchaseRequest->status = $request->status;
        $purchaseRequest->tanggal = $request->tanggal;
        $purchaseRequest->tanggal_dibutuhkan = $request->tanggal_dibutuhkan;
        $purchaseRequest->save();

        return redirect()->route('purchase-requests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param PurchaseRequest $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequest $purchaseRequest)
    {
        if (!check_user_access(Session::get('user_access'), 'minta_read')) {
            return redirect('/');
        }

        $data['beli_minta'] = $purchaseRequest;
        dd($purchaseRequest);
        return view('minta.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PurchaseRequest $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        if (!check_user_access(Session::get('user_access'), 'minta_update')) {
            return redirect('/');
        }

        $data['actions'] = 'update';
        $data['beli_minta'] = $purchaseRequest;

        return view('minta.minta', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param PurchaseRequest $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        //
        if (!check_user_access(Session::get('user_access'), 'minta_update')) {
            return redirect('/');
        }

        $purchaseRequest->created_id = Auth::user()->id;
        $purchaseRequest->updated_id = Auth::user()->id;
        $purchaseRequest->no_faktur = $request->no_faktur;
        $purchaseRequest->id_user_pemohon = $request->id_user_pemohon;
        $purchaseRequest->id_user_menyetujui = $request->id_user_menyetujui;
        $purchaseRequest->status = $request->status;
        $purchaseRequest->tanggal = $request->tanggal;
        $purchaseRequest->tanggal_dibutuhkan = $request->tanggal_dibutuhkan;
        $purchaseRequest->save();

        return redirect()->route('purchase-requests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PurchaseRequest $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->delete();
        return redirect()->route('purchase-requests.index');
    }
}
