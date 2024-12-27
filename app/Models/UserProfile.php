<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'gender',
        'pro_noun',
        'address',
        'suburb',
        'city',
        'state',
        'post_code',
        'country',
        'job_title',
        'facebook_url',
        'linkedin_url',
        'instagram_url',
        'twitter_url',
    ];
}
