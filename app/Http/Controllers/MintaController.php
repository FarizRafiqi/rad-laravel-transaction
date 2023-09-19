<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MMinta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MintaController extends Controller
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
        $data = DB::table('beli_minta')->get();
        return view('minta.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (!check_user_access(Session::get('user_access'), 'minta_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        return view('minta.minta', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'minta_create')) {
            return redirect('/');
        }

        $minta = new MMinta();
        $minta->created_id = Auth::user()->id;
        $minta->updated_id = Auth::user()->id;
        $minta->no_faktur = $request->no_faktur;
        $minta->id_user_pemohon = $request->id_user_pemohon;
        $minta->id_user_menyetujui = $request->id_user_menyetujui;
        $minta->status = $request->status;
        $minta->tanggal = $request->tanggal;
        $minta->tanggal_dibutuhkan = $request->tanggal_dibutuhkan;


        $minta->save();

        return redirect()->route('minta.index');
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
        if (!check_user_access(Session::get('user_access'), 'minta_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['beli_minta'] = MMinta::find($id);
        return view('minta.show', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'minta_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['actions'] = 'update';
        $data['beli_minta'] = MMinta::find($id);
        return view('minta.minta', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'minta_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);

        $minta = MMinta::find($id);
        $minta->created_id = Auth::user()->id;
        $minta->updated_id = Auth::user()->id;
        $minta->no_faktur = $request->no_faktur;
        $minta->id_user_pemohon = $request->id_user_pemohon;
        $minta->id_user_menyetujui = $request->id_user_menyetujui;
        $minta->status = $request->status;
        $minta->tanggal = $request->tanggal;
        $minta->tanggal_dibutuhkan = $request->tanggal_dibutuhkan;

        $minta->save();

        return redirect()->route('minta.index');
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
