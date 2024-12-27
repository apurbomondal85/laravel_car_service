<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailRecipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscriber_id',
        'email_id',
        'is_sent',
        'try'
    ];
    /*=====================Eloquent Relations======================*/
    public function email()
    {
        return $this->belongsTo(Email::class, 'email_id');
    }

    public function subscriber()
    {
        return $this->hasOne(Subscriber::class, 'id', 'subscriber_id');
    }
    /*=====================End Eloquent Relations======================*/
}
