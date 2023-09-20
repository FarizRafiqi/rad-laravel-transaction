<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\PurchaseRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahBarang = Barang::all()->count();
        $jumlahOrder = Order::all()->count();
        $jumlahPengguna = User::all()->count();
        $jumlahReqOrder = PurchaseRequest::all()->count();

        return view('home', compact(
            'jumlahBarang', 'jumlahOrder',
            'jumlahPengguna', 'jumlahReqOrder'
        ));
    }
}
