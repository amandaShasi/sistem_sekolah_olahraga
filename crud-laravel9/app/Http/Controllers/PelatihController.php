<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class pelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $data = pelatih::get();
        $data = DB::select("SELECT pelatih.*, cabor.id_cabor AS id_cabor, cabor.jenis_cabor AS jenis_cabor 
        FROM pelatih 
        JOIN cabor ON pelatih.id_cabor = cabor.id_cabor");
        return view('pelatih.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::select("SELECT * from cabor");
        return view('pelatih.form', compact('data'));
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
            'Nama_pelatih' => 'required',
            'id_cabor' => 'required', // Ensure this matches the name in the form
            'Jenis_kelamin' => 'required'
        ]);
        
        DB::insert("INSERT INTO `pelatih` (`Nama_pelatih`, `id_cabor`, `Jenis_kelamin`) VALUES (?, ?, ?)",
            [$request->Nama_pelatih, $request->id_cabor, $request->Jenis_kelamin]);
        
        return redirect()->route('pelatih.index')->with(['success' => 'Data berhasil disimpan!']);
        
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
        $datas = DB::select("SELECT * from cabor");
        $data=DB::table('pelatih')->where('id_pelatih', $id)->first();
        return view('pelatih.change', compact('data', 'datas'));
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
        DB::update("UPDATE pelatih SET `Nama_pelatih`=?, `id_cabor`=?, `Jenis_kelamin`=? WHERE `id_pelatih`=?",
            [$request->Nama_pelatih, $request->id_cabor, $request->Jenis_kelamin, $id]);
    
        return redirect()->route('pelatih.index')->with(['success' => 'Data berhasil diupdate!']);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pelatih')->where('id_pelatih', $id)->delete();

        //redirect to index
        return redirect()->route('pelatih.index')->with(['success' => 'data berhasil dihapus!']);
    }
}
