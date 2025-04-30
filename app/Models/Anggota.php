<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id_anggota',
        'nama',
        'alamat',
        'jenis_kelamin',
        'no_telp',
        'tgl_lahir',
    ];

    // Relationships
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota');
    }

    public function denda()
    {
        return $this->hasMany(Denda::class, 'id_anggota');
    }
}
