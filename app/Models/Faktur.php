<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faktur extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'no_faktur',
        'tanggal_faktur',
        'due_date',
        'metode_bayar',
        'ppn',
        'dp',
        'total',
        'grand_total',
        'customer_id',
        'perusahaan_id',
        'user_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function detailFakturs()
    {
        return $this->hasMany(DetailFaktur::class, 'no_faktur', 'no_faktur');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
