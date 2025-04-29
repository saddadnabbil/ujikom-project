<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CashTransactionExpenditure extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['expenditure', 'amount', 'is_paid', 'date', 'note'];

    protected $casts = [
        'is_paid' => 'integer',
    ];

    /**
     * Get users relation data.
     *
     * @return BelongsTo
     */
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Set date attribute when storing data.
     *
     * @param string $value
     * @return void
     */
    public function setDateAttribute(string $value): void
    {
        $this->attributes['date'] = date('Y-m-d', strtotime($value));
    }
}
