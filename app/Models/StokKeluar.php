<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokKeluar extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'produk_id',
        'stok_keluar',
        'harga_jual',
        'keterangan',
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class);
    }
}