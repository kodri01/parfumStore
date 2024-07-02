<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori_id',
        'nama_barang',
        'satuan',
        'harga',
        'file',
    ];

    public function stokMasuk()
    {
        return $this->hasMany(StokMasuk::class, 'produk_id');
    }

    public function stokKeluar()
    {
        return $this->hasMany(StokKeluar::class, 'produk_id');
    }

    public function order()
    {
        return $this->hasMany(OrderStok::class, 'produk_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            // Hapus data terkait
            $product->stokMasuk()->delete();
            $product->stokKeluar()->delete();
            $product->order()->delete();
        });
    }

    public function getTotalHargaStokKeluar()
    {
        return $this->stokKeluar->sum(function ($stokKeluar) {
            return $stokKeluar->stok_keluar * $this->harga;
        });
    }
}