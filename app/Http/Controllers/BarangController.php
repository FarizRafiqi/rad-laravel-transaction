<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'barang_manage')) {
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
        if (!check_user_access(Session::get('user_access'), 'barang_manage')) {
            return redirect('/');
        }

        $data = Barang::all();
        return view('barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_user_access(Session::get('user_access'), 'barang_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        return view('barang.create-or-edit', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'barang_create')) {
            return redirect('/');
        }

        $barang = new Barang();
        $barang->created_id = Auth::user()->id;
        $barang->updated_id = Auth::user()->id;
        $barang->nama = $request->nama;
        $barang->keterangan = $request->keterangan;
        $barang->save();

        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        if (!check_user_access(Session::get('user_access'), 'barang_read')) {
            return redirect('/');
        }

        $id = base64_decode($barang->id);
        $data['barang'] = $barang;

        return view('barang.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        if (!check_user_access(Session::get('user_access'), 'barang_update')) {
            return redirect('/');
        }

        $id = base64_decode($barang->id);
        $data['actions'] = 'update';
        $data['barang'] = $barang;

        return view('barang.create-or-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        if (!check_user_access(Session::get('user_access'), 'barang_update')) {
            return redirect('/');
        }

        $id = base64_decode($barang->id);

        $barang->updated_id = Auth::user()->id;
        $barang->nama = $request->nama;
        $barang->keterangan = $request->keterangan;
        $barang->save();

        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index');
    }
}
