<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'peminjamen';

    protected $fillable = [
        'id_pinjam',
        'lama_pinjam',
        'nominal_denda',
        'id_anggota',
        'id_denda',
        'id_user',
    ];

    // Relationships
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function denda()
    {
        return $this->belongsTo(Denda::class, 'id_denda');
    }

    public function detailPinjam()
    {
        return $this->hasMany(DetailPinjam::class, 'id_pinjam');
    }
}
