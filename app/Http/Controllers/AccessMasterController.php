<?php

namespace App\Http\Controllers;

use App\Models\AccessMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class AccessMasterController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'access_master_manage')) {
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
        if (!check_user_access(Session::get('user_access'), 'access_master_manage')) {
            return redirect('/');
        }
        $data = DB::table('access_master')->get();

        return view('access_master.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_user_access(Session::get('user_access'), 'access_master_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        return view('access_master.access_master', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'access_master_create')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('access_masters.create')->withErrors($validator);
        }
        $access_master = new AccessMaster();
        $access_master->nama = $request->nama;
        $access_master->keterangan = $request->keterangan;
        $access_master->created_id = Auth::user()->id;
        $access_master->updated_id = Auth::user()->id;
        $access_master->save();

        return redirect()->route('access_masters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!check_user_access(Session::get('user_access'), 'access_master_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['access_master'] = AccessMaster::find($id);
        return view('access_master.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!check_user_access(Session::get('user_access'), 'access_master_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['actions'] = 'update';
        $data['access_master'] = AccessMaster::find($id);
        return view('access_master.access_master', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'access_master_update')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('access_masters.edit', $id)->withErrors($validator);
        }

        $id = base64_decode($id);

        $access_master = AccessMaster::find($id);
        $access_master->nama = $request->nama;
        $access_master->keterangan = $request->keterangan;
        $access_master->updated_id = Auth::user()->id;
        $access_master->save();

        return redirect()->route('access_masters.index');
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
