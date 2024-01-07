<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\siswa;
class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::select("SELECT siswa.*, cabor.id_cabor AS id_cabor, cabor.jenis_cabor AS jenis_cabor 
        FROM siswa 
        JOIN cabor ON siswa.id_cabor = cabor.id_cabor");
        return view('siswa.data', compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::select(DB::raw("SELECT id_cabor, jenis_cabor from cabor"));
        return view('siswa.form', compact('data'));
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
            'nisn',
            'Nama_siswa' ,
            'Tempat_lahir' ,
            'Tanggal_lahir' ,
            'Kelas',
            'id_cabor',
        ]);

        DB::insert("INSERT INTO `siswa` (`nisn`,`Nama_siswa`,`Tempat_lahir`, `Tanggal_lahir`, `Jenis_kelamin`, `Kelas`, `id_cabor`) VALUES (?,?,?,?,?,?,?)",
        [$request->nisn,$request->Nama_siswa,$request->Tempat_lahir,$request->Tanggal_lahir,$request->Jenis_kelamin,$request->Kelas,$request->id_cabor]);
        return redirect()->route('siswa.index')->with(['success'=> 'data berhasil disimpan!']);
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
        $datas = DB::select(DB::raw("SELECT id_cabor, jenis_cabor from cabor"));
        $data =DB::table('siswa')->where('id', $id)->first();
        return view('siswa.change', compact('data', 'datas'));
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
        DB::update("UPDATE siswa SET `nisn`=?,`Nama_siswa`=?, `Tempat_lahir`=?, `Tanggal_lahir`=?, `Jenis_kelamin`=?, `Kelas`=?, `id_cabor`=? WHERE id=?",
        [$request->nisn,$request->Nama_siswa,$request->Tempat_lahir,$request->Tanggal_lahir,$request->Jenis_kelamin,$request->Kelas,$id]);
        return redirect()->route('siswa.index')->with(['success'=> 'data berhasil disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('siswa')->where('id', $id)->delete();

        //redirect to index
        return redirect()->route('siswa.index')->with(['success' => 'data berhasil dihapus!']);
    }
}
