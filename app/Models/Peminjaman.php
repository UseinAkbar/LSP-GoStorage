<?php

namespace App\Models;

use App\Models\User;
use App\Models\Gudang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = "peminjaman";
    protected $fillable = [
        'users_id',
        'gudang_id',
        'durasi',
        'status_sewa',
        'tanggal_pinjam',
        'tanggal_wajib_kembali',
        'tanggal_pengembalian',
        'denda',
        'total_harga'
    ];
}
