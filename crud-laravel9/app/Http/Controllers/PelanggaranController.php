<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\pelanggaran;
class pelanggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = pelanggaran::get();
        $data = DB::select("SELECT pelanggaran.*, siswa.id, siswa.id_cabor AS ids, siswa.Nama_siswa AS Nama_siswa 
        FROM pelanggaran 
        JOIN siswa ON pelanggaran.id = siswa.id");
        return view('pelanggaran.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::select("SELECT * from siswa");
        return view('pelanggaran.form', compact('data'));
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
            'jenis_pelanggaran' => 'required',
            'waktu' => 'required'
        ]);

        DB::insert("INSERT INTO `pelanggaran` (`id`,`jenis_pelanggaran`,`waktu`) VALUES (?,?,?)",
        [$request->id, $request->jenis_pelanggaran,$request->waktu]);
        return redirect()->route('pelanggaran.index')->with(['success'=> 'data berhasil disimpan!']);
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
        $data=DB::table('pelanggaran')->where('id_pelanggaran', $id)->first();
        return view('pelanggaran.change', compact('data', 'datas'));
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
    $this->validate($request, [
        'id' => 'required',
        'jenis_pelanggaran' => 'required',
        'waktu' => 'required'
    ]);

    DB::update(
        "UPDATE `pelanggaran` SET `jenis_pelanggaran`=?, `waktu`=?, `id`=? WHERE `id_pelanggaran`=?",
        [$request->jenis_pelanggaran, $request->waktu, $request->id, $id]
    );

    return redirect()->route('pelanggaran.index')->with(['success' => 'data berhasil disimpan!']);
}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pelanggaran')->where('id_pelanggaran', $id)->delete();

        //redirect to index
        return redirect()->route('pelanggaran.index')->with(['success' => 'data berhasil dihapus!']);
    }
}

