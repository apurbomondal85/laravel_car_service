<?php

namespace App\Models;

use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'user_name',
        'is_admin_reply',
        'comment',
        'attachment',
    ];

    /*=====================Eloquent======================*/

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /*=====================End======================*/

    public static function insert($ticket, array $data)
    {
        $find_user = User::getAuthUser();
        $data['user_id'] = $find_user->id;
        $data['user_name'] = User::find($find_user->id)->getFullNameAttribute();
        $data['is_admin_reply'] = $find_user->user_type == Enum::USER_TYPE_ADMIN ? 1 : 0;

        $data['ticket_id'] = $ticket->id;

        if(isset($data['attachment'])) {
            $data['attachment'] = Helper::uploadFile($data['attachment'], Enum::TICKET_ATTACHMENT_DIR);
        }

        return self::create($data);
    }
}
