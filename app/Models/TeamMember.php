<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'user_id',
        'operator_id',
        'team_designation',
        'member_note',
        'is_active',
        'is_featured',
    ];

    /*=====================Eloquent======================*/

    public function team(): BelongsTo
    {
        return $this-> BelongsTo(Team::class);
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*=====================End======================*/

    public function scopeActive($query)
    {
        return $query->whereIsActive(true);
    }

    public function scopeFeatured($query)
    {
        return $query->whereIsFeatured(true);
    }
}
