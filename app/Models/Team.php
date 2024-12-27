<?php

namespace App\Models;

use App\Library\Enum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'is_active',
        'is_featured',
        'operator_id'
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }



    public function scopeActive($query)
    {
        return $query->whereIsActive(Enum::STATUS_ACTIVE);
    }

    public function scopeFeatured($query)
    {
        return $query->whereIsFeatured(true);
    }

    public static function findActiveFeaturedTeam()
    {
        return self::active()->featured()->first();
    }

}
