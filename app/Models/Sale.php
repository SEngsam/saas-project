<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'amount',
        'currency',
        'payment_method',
        'status',
        'transaction_id',
        'paid_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
