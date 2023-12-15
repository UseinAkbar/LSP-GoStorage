<?php

namespace App\Models;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gudang extends Model
{
    use HasFactory;

    protected $table = "gudang";

    protected $fillable = [
        'nama_gudang',
        'kode_gudang',
        'lokasi',
        'deskripsi',
        'harga',
        'gambar',
        'luas',
        'status'
    ];

    /**
     * The roles that belong to the Gudang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function kategori()
    {
        return $this->belongsToMany(Kategori::class);
    }
}
