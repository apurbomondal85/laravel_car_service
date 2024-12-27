<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleOfHonor extends Model
{
    use HasFactory;

    protected $fillable = [
        'session',
        'president',
        'vice_president',
        'general_secretary',
        'treasurer',
    ];
}
