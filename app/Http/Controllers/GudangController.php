<?php

namespace App\Http\Controllers;

use File;
use App\Models\QRhistory;
use App\Models\Peminjaman;
use App\Models\Kategori;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GudangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Gudang::limit(4)->get();
        return view('home', ['data' => $data]);
    }

    public function detail($id)
    {
        $data = DB::table('gudang')->where('id', $id)->first();
        return view('detail', ['data' => $data]);
    }

    public function rekomendasi()
    {
        $data = Gudang::all();
        return view('rekomendasi', ['data' => $data]);
    }

    public function listGudang()
    {
        $data = Gudang::all();
        return view('list', ['data' => $data, 'gudang' => NULL]);
    }

    public function listGudangSearch($gudang)
    {
        $data =  DB::table('gudang')->where('nama_gudang', 'like', "%$gudang%")->orWhere('lokasi', 'like', "%$gudang%")->get();
        return view('list', ['data' => $data, 'gudang' => $gudang]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('dashboard.gudang.gudang_create', ['kategori'=>$kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_gudang' => 'required',
            'kode_gudang' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'luas' => 'required',
            'gambar' => 'required',
        ]);

        $filename = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images'), $filename);

        $gudang = new Gudang([
            'nama_gudang' => $request->nama_gudang,
            'kode_gudang' => $request->kode_gudang,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'gambar' => $filename,
            'luas' => $request->luas,
            'status' => 'available'
        ]);
        
        $gudang->save();
        $kategori = $request->input('kategori');
        $gudang->kategori()->attach($kategori);
        return redirect()->route('dashboard.gudang')->with('success', 'Berhasil Membuat Gudang');
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
        $data = Gudang::find($id);
        $kategori = Kategori::all();
        return view('dashboard.gudang.gudang_edit', ['data' => $data, 'kategori' => $kategori]);
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
        $gudang = Gudang::find($id);
        if($request->gambar  != NULL){
            // $file = $request->file('gambar');
            // $filename = uniqid() . "_" . $file->getClientOriginalName();
            // $file->storeAs('public/', $filename);
            $path = 'images/';
            File::delete($path . $gudang->gambar);

            $filename = time() . '.' . $request->gambar->extension();

            $request->gambar->move(public_path('images'), $filename);

            $gudang->gambar = $filename;

            $gudang->update([
                'nama_gudang' => $request->nama_gudang,
                'kode_gudang' => $request->kode_gudang,
                'lokasi' => $request->lokasi,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'gambar' => $filename,
                'luas' => $request->luas
            ]);
        }else{
            $gudang->update([
                'nama_gudang' => $request->nama_gudang,
                'kode_gudang' => $request->kode_gudang,
                'lokasi' => $request->lokasi,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'luas' => $request->luas
            ]);
        }
        $kategori = $request->input('kategori');
        $gudang->kategori()->sync($kategori);
        return redirect()->route('dashboard.gudang')->with('success', 'Berhasil Mengubah Gudang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gudang = Gudang::find($id);
        $gudang->delete();
        
        return redirect()->route('dashboard.gudang')->with('success', 'Berhasil Menghapus Gudang');
    }
}
