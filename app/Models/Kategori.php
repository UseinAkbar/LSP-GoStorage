<?php

namespace App\Models;

use App\Models\Gudang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Kategori extends Model
{
    use HasFactory;
    protected $table ="kategori";
    protected $fillable = ['nama'];

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function gudang()
    {
        return $this->belongsToMany(Gudang::class);
    }
}
