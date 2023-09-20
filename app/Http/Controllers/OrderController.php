<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        if (!check_user_access(Session::get('user_access'), 'order_manage')) {
            return redirect('/');
        }

        $data = Order::all();
        return view('order.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_user_access(Session::get('user_access'), 'order_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        return view('order.order', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'order_create')) {
            return redirect('/');
        }

        $order = new Order();
        return $this->updateOrCreate($request, $order);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if (!check_user_access(Session::get('user_access'), 'order_read')) {
            return redirect('/');
        }

        $data['beli_order'] = $order;
        return view('order.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if (!check_user_access(Session::get('user_access'), 'order_update')) {
            return redirect('/');
        }

        $data['actions'] = 'update';
        $data['beli_order'] = $order;

        return view('order.order', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Order $order)
    {
        if (!check_user_access(Session::get('user_access'), 'order_update')) {
            return redirect('/');
        }

        return $this->updateOrCreate($request, $order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }

    /**
     * @param Request $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function updateOrCreate(Request $request, Order $order)
    {
        $userId = Auth::user()->id;

        DB::beginTransaction();
        try {
            $order->created_id = $userId;
            $order->updated_id = $userId;
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
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return redirect()->route('orders.index');
    }
}
