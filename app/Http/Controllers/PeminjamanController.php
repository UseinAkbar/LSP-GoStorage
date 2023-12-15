<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Gudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isAdmin == 1) {
            $pelanggan = Peminjaman::join('gudang', 'gudang.id', '=', 'peminjaman.gudang_id')->join('users', 'users.id', '=', 'peminjaman.users_id')
                ->select('users.*', 'peminjaman.*', 'gudang.*', 'peminjaman.created_at as tanggal')
                ->orderBy('peminjaman.updated_at','desc')
                ->get();
            return view('dashboard.peminjaman.transaksi_read', ['data' => $pelanggan]);
        } else {
            $data = Peminjaman::join('gudang', 'gudang.id', '=', 'peminjaman.gudang_id')
            ->select('peminjaman.*', 'gudang.*', 'peminjaman.created_at as tanggal')
            ->where('peminjaman.users_id', Auth::user()->id)
            ->orderBy('peminjaman.updated_at','desc')
            ->get();
            return view('dashboard.peminjaman.transaksi_read', ['data' => $data]);
        }
    }

    public function history()
    {
        if (Auth::user()->isAdmin == 1) {
            $data = Peminjaman::join('gudang', 'gudang.id', '=', 'peminjaman.gudang_id')
                ->select('peminjaman.*', 'gudang.*', 'peminjaman.created_at as tanggal')
                ->orderBy('peminjaman.updated_at','desc')
                ->get();
            return view('dashboard.peminjaman.history', ['data' => $data]);
        } else {
            $data = Peminjaman::join('gudang', 'gudang.id', '=', 'peminjaman.gudang_id')
                ->select('peminjaman.*', 'gudang.*', 'peminjaman.created_at as tanggal')
                ->where('peminjaman.users_id', Auth::user()->id)
                ->orderBy('peminjaman.updated_at','desc')
                ->get();
            return view('dashboard.peminjaman.history', ['data' => $data]);
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

        $gudang = Gudang::findOrFail($request->gudangid);
        $countPeminjaman = Peminjaman::where('users_id',$request->userid)->where('tanggal_pengembalian',null)->count();

        // Cek batas penyewaan unit per user
        if($countPeminjaman >= 2) {
            return redirect()->route('gudang.list')->withErrors(['wrong' => 'Batas maksimal penyewaan adalah 2 unit gudang']);
        }
        else {
            try {
                if ($gudang->status == 'available') { 
                    $peminjaman = new Peminjaman([
                        'gudang_id' => $request->gudangid,
                        'users_id' => Auth::user()->id,
                        'durasi' => $request->durasi,
                        'status_sewa' => 'On Rent',
                        'tanggal_pinjam' => Carbon::now()->toDateString(),
                        'tanggal_wajib_kembali' => Carbon::now()->addDay($request->durasi)->toDateString(),
                        'denda' => "0",
                        'total_harga' => $request->total
                    ]);
                    $peminjaman->save();

                    // Cek status ketersediaan gudang
                    $countGudang = Peminjaman::where('gudang_id',$request->gudangid)->count();
                    $gudang = Gudang::findOrFail($request->gudangid);
                    $gudang->status = 'unavailable';
                    $gudang->save();

                    return redirect()->route('dashboard.history')->with('success', 'Transaksi Penyewaan Berhasil Dilakukan');
                } else {
                    return redirect()->back()->withErrors(['wrong' => 'Gudang Tidak Tersedia']);
                }
            } catch (\Throwable $th) {
                DB::rollback();
            }
        }

    }

    // public function tampil()
    // {
    //     $data = Peminjaman::find($id);
    //     return view('dashboard.peminjaman.transaksi_read', ['data' => $data]);
    // }


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
        $data = Peminjaman::find($id);
        return view('dashboard.peminjaman.transaksi_read', ['data' => $data]);
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
        // $transaksi = Peminjaman::find($id);
        // $transaksi->update([
        //     'id_wisata' => $request->wisataid,
        //     'id_user' => Auth::user()->id,
        //     'kode_tiket' => rand(0, 999999999),
        //     'jumlah_tiket' => $request->total,
        //     'total_harga' => $request->total * $request->harga,
        //     'metode_pembayaran' => $request->metode,
        // ]);

        // return redirect()->route('qr.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaksi = Peminjaman::find($id);
        $transaksi->delete();
        
    }
}
