<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;
class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::select(DB::raw("select * from berita"));
        return view('berita.data', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'Gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'Deskripsi' => 'required|string',
        'Waktu' => 'required|date',
    ]);

    // Upload image
    $image = $request->file('Gambar');
    $imageName = $image->hashName();
    $image->storeAs('public/berita', $imageName);

    // Store data in the database using raw SQL query
    DB::insert("INSERT INTO `berita` (`Gambar`, `Deskripsi`, `Waktu`) VALUES (?, ?, ?)",
        [$imageName, $request->Deskripsi, $request->Waktu]);

    return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Disimpan']);
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
        $data=DB::table('berita')->where('id_berita',$id)->first();
        return view('berita.change' , compact('data'));
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
        // Validate the request data
        $request->validate([
            'Gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'Deskripsi' => 'required|string',
            'Waktu' => 'required|date',
        ]);
    
        if ($request->file('Gambar')) {
            // If a new image is provided, upload and update the image
            $image = $request->file('Gambar');
            $imageName = $image->hashName();
            $image->storeAs('public/berita', $imageName);
    
            DB::update("UPDATE `berita` SET `Gambar`=?, `Deskripsi`=?, `Waktu`=? WHERE `id_berita`=?",
                [$imageName, $request->Deskripsi, $request->Waktu, $id]);
        } else {
            // If no new image is provided, update other fields
            DB::update("UPDATE `berita` SET `Deskripsi`=?, `Waktu`=? WHERE `id_berita`=?",
                [$request->Deskripsi, $request->Waktu, $id]);
        }
    
        return redirect()->route('berita.index')->with(['success' => 'Data Berhasil Diupdate']);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('berita')->where('id_berita', $id)->delete();

        //redirect to index
        return redirect()->route('berita.index')->with(['success' => 'data berhasil dihapus!']);
    }
}
