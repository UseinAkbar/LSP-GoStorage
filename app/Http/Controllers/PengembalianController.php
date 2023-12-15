<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function pengembalian(Request $request)
    {
        $pinjaman = Peminjaman::where('users_id', $request->userid)->where('gudang_id', $request->gudangid)
        ->where('tanggal_pengembalian',null);
        $count = $pinjaman->count();

        if ($count >= 1) {
            // Update data peminjaman
            $pinjaman->update([
                'tanggal_pengembalian' => Carbon::now()->toDateString(),
                'status_sewa' => 'Loan Complete',
                'denda' => strtotime(Carbon::now()->toDateString()) > strtotime($pinjaman->value('tanggal_wajib_kembali')) ? "2000000" : "0"
            ]);
            
            // Update data gudang
            $gudang = Gudang::find($request->gudangid);
            $gudang->update([
                'status' => 'available'
            ]);

            return redirect()->route('dashboard.transaksi')->with('success', 'Penyewaan Berhasil Direturn');
        } else {
            return redirect()->route('dashboard.transaksi')->withErrors(['wrong' => 'Transaksi Peminjaman Tidak Ditemukan']);
        }
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
        //
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
        //
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
        //
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
