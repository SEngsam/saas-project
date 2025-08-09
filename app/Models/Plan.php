<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Plan extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'price',
        'duration',
        'features',
        'is_active',
    ];

        protected static function boot()
    {
        parent::boot();

        static::saving(function ($plan) {
            if (empty($plan->slug)) {
                $slug = Str::slug($plan->name);


                $count = static::where('slug', 'LIKE', "{$slug}%")->count();
                $plan->slug = $count ? "{$slug}-{$count}" : $slug;
            }
        });
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
