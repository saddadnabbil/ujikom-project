<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailFaktur extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'faktur_id',
        'produk_id',
        'jumlah',
        'harga_satuan',
        'subtotal',
    ];

    public function faktur()
    {
        return $this->belongsTo(Faktur::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
