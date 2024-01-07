<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = pelatih::get();
        $data = DB::select("SELECT prestasi.*, siswa.id, siswa.id_cabor AS ids, siswa.Nama_siswa AS Nama_siswa 
        FROM prestasi 
        JOIN siswa ON prestasi.id = siswa.id");
        return view('prestasi.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::select("SELECT * from siswa");
        return view('prestasi.form', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'jenis_prestasi' => 'required',
            'waktu' => 'required'
        ]);

        DB::insert("INSERT INTO `prestasi` (`id`, `jenis_prestasi`,`waktu`) VALUES (?,?,?)",
        [$request->id, $request->jenis_prestasi,$request->waktu]);
        return redirect()->route('prestasi.index')->with(['success'=> 'data berhasil disimpan!']);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = DB::select("SELECT * from siswa");
        $data = DB::table('prestasi')->where('id_prestasi', $id)->first();
        return view('prestasi.change', compact('data', 'datas'));
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
        DB::insert("UPDATE `prestasi` SET `id`=?, `jenis_prestasi`=?,`waktu`=? WHERE id_prestasi=?",
        [$request->id, $request->jenis_prestasi,$request->waktu,$id]);
        return redirect()->route('prestasi.index')->with(['success'=> 'data berhasil disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('prestasi')->where('id_prestasi', $id)->delete();

        //redirect to index
        return redirect()->route('prestasi.index')->with(['success' => 'data berhasil dihapus!']);
    }
}

