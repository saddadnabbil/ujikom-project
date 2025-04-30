<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'judul',
        'pengarang',
        'penerbit',
        'tahun',
        'isbn',
        'tgl_input',
        'jml_halaman',
        'id_kategori',
    ];

    // Relationships
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function detailPinjam()
    {
        return $this->hasMany(DetailPinjam::class, 'id_buku');
    }
}
