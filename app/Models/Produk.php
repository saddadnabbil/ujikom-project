<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produks'; 

    protected $fillable = [
        'id_produk', 
        'nama_produk',
        'price',
        'jenis',
        'stock',
    ];

    protected $primaryKey = 'id_produk';
}
