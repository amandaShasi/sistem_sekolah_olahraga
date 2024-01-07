<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\cabor;
class CaborController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data = cabor::get();
        $data=DB::select(DB::raw("select * from cabor"));
        return view('cabor.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cabor.form');
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
            'jenis_cabor' => 'required'
        ]);

        DB::insert("INSERT INTO `cabor` (`jenis_cabor`) VALUES (?)",
        [$request->jenis_cabor]);
        return redirect()->route('cabor.index')->with(['success'=> 'data berhasil disimpan!']);
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
        $data=DB::table('cabor')->where('id_cabor', $id)->first();
        return view('cabor.change', compact('data'));
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
        DB::update("UPDATE `cabor` SET `jenis_cabor`=? WHERE id_cabor=?",
        [$request->jenis_cabor,$id]);
        return redirect()->route('cabor.index')->with(['success'=> 'data berhasil disimpan!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('cabor')->where('id_cabor', $id)->delete();

        //redirect to index
        return redirect()->route('cabor.index')->with(['success' => 'data berhasil dihapus!']);
    }
}
