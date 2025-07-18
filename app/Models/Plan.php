<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration_days',
        'description',
        'start_date',
        'end_date',
        'status',
        'assignee',
    ];
    public function sales()
{
    return $this->hasMany(Sale::class);
}
}
