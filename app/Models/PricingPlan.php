<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'is_featured',
        'is_active',
        'operator_id',
    ];

    public function operator()
    {
        return $this->hasOne(User::class, 'id', 'operator_id');
    }
}
