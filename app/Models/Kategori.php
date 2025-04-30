<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_kategori',
        'kategori_buku',
    ];

    // Relationships
    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_kategori');
    }
}
