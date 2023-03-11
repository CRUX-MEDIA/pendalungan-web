<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Level;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $level = Level::all();
        return view('pegawai.index', compact('level'));
    }

    public function dataPegawai() {
        $pegawai = User::join('level', 'level.id_level', '=', 'users.id_level')
                    ->orderBy('id', 'desc')
                    ->get();
        $no = 0;
        $data = array();
        foreach ($pegawai as $list) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->name;
            $row[] = $list->email;
            $row[] = $list->nama_level;
            $row[] = '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="editForm('.$list->id.')"><i class="fas fa-pencil-alt"></i></a> 
            <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="deleteData('.$list->id.')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }
        return DataTables::of($data)->escapeColumns([])->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pegawai = new User;
        $pegawai->name = $request->name;
        $pegawai->email = $request->email;
        $pegawai->hp = $request->hp;
        $pegawai->id_level = $request->id_level;
        $pegawai->password = bcrypt($request->password);
        $pegawai->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pegawai = User::find($id);
        echo json_encode($pegawai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pegawai = User::find($id);
        $pegawai->name = $request->name;
        $pegawai->email = $request->email;
        $pegawai->hp = $request->hp;
        $pegawai->id_level = $request->id_level;
        $pegawai->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = User::find($id);
        $pegawai->delete();
    }
}
