<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderStok extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'produk_id',
        'no_order',
        'satuan',
        'qty',
        'harga',
        'sub_total',
        'ongkir',
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class);
    }
}