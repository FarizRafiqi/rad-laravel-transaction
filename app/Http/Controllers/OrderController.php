<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'order_manage')) {
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
        if (!check_user_access(Session::get('user_access'), 'order_manage')) {
            return redirect('/');
        }
        $data = DB::table('beli_order')->get();
        return view('order.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!check_user_access(Session::get('user_access'), 'order_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        return view('order.order', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if (!check_user_access(Session::get('user_access'), 'order_create')) {
            return redirect('/');
        }

        $order = new MOrder();
        $order->created_id = Auth::user()->id;
        $order->updated_id = Auth::user()->id;
        $order->no_faktur = $request->no_faktur;
        $order->id_m_vendor = $request->id_m_vendor;
        $order->id_user_verifikasi = $request->id_user_verifikasi;
        $order->jumlah = $request->jumlah;
        $order->ppn_percent = $request->ppn_percent;
        $order->pp_nominal = $request->pp_nominal;
        $order->total = $request->total;
        $order->status = $request->status;
        $order->tanggal = $request->tanggal;
        $order->tanggal_dibutuhkan = $request->tanggal_dibutuhkan;


        $order->save();

        return redirect()->route('order.index');
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
        if (!check_user_access(Session::get('user_access'), 'order_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['beli_order'] = MOrder::find($id);
        return view('order.show', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'order_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['actions'] = 'update';
        $data['beli_order'] = MOrder::find($id);
        return view('order.order', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'order_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);

        $order = MOrder::find($id);
        $order->created_id = Auth::user()->id;
        $order->updated_id = Auth::user()->id;
        $order->no_faktur = $request->no_faktur;
        $order->id_m_vendor = $request->id_m_vendor;
        $order->id_user_verifikasi = $request->id_user_verifikasi;
        $order->jumlah = $request->jumlah;
        $order->ppn_percent = $request->ppn_percent;
        $order->pp_nominal = $request->pp_nominal;
        $order->total = $request->total;
        $order->status = $request->status;
        $order->tanggal = $request->tanggal;
        $order->tanggal_dibutuhkan = $request->tanggal_dibutuhkan;

        $order->save();

        return redirect()->route('order.index');
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
}
