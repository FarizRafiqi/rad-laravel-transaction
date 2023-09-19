<?php

namespace App\Http\Controllers;

use App\Models\AccessGroup;
use App\Models\AccessMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AccessGroupController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'access_group_manage')) {
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
        if (!check_user_access(Session::get('user_access'), 'access_group_manage')) {
            return redirect('/');
        }
        $data = DB::table('access_group')->get();
        return view('access_group.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_user_access(Session::get('user_access'), 'access_group_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        $data['access_master'] = AccessMaster::all();
        // dd($data['access_master']);
        return view('access_group.access_group', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'access_group_create')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('access_groups.create')->withErrors($validator);
        }


        $access_group = new AccessGroup();
        $access_group->nama = $request->nama;
        $access_group->keterangan = $request->keterangan;

        $access_detail = '';
        foreach($request->access_masters as $access_master)
        {
            $access_master = AccessMaster::find($access_master);
            $access_detail .= $access_master->nama . ';;';
        }

        $access_group->access_detail = $access_detail;
        $access_group->created_id = Auth::user()->id;
        $access_group->updated_id = Auth::user()->id;
        $access_group->save();

        foreach ($request->access_masters as $access_master) {
            $access_master = AccessMaster::find($access_master);
            $access_group->access_masters()->attach($access_master->id);
        }

        return redirect()->route('access_groups.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!check_user_access(Session::get('user_access'), 'access_group_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['access_group'] = AccessGroup::find($id);
        return view('access_group.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!check_user_access(Session::get('user_access'), 'access_group_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['actions'] = 'update';
        $data['access_master'] = AccessMaster::all();
        $data['access_group'] = AccessGroup::find($id);
        return view('access_group.access_group', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'access_group_update')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('access_groups.edit', $id)->withErrors($validator);
        }

        $id = base64_decode($id);

        $access_group = AccessGroup::find($id);
        $access_group->access_masters()->detach();

        $access_group->nama = $request->nama;
        $access_group->keterangan = $request->keterangan;

        $access_detail = '';
        foreach ($request->access_masters as $access_master) {
            $access_master = AccessMaster::find($access_master);
            $access_detail .= $access_master->nama . ';;';
        }

        $access_group->access_detail = $access_detail;
        $access_group->updated_id = Auth::user()->id;
        $access_group->save();

        foreach ($request->access_masters as $access_master) {
            $access_master = AccessMaster::find($access_master);
            $access_group->access_masters()->attach($access_master->id);
        }

        return redirect()->route('access_groups.index');
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
