<?php

namespace App\Models;

use App\Library\Enum;
use App\Library\Helper;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'org_id',
        'user_id',
        'full_name',
        'subject',
        'message',
        'attachment',
        'department',
        'status',
        'priority',
        'assign_to_id',
        'created_by',
    ];

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    /*=====================Eloquent======================*/

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function employee()
    {
        return $this->hasOne(User::class, 'id', 'assign_to_id');
    }

    public function replies(string $order_by = 'asc')
    {
        return $this->hasMany(TicketReply::class, 'ticket_id', 'id')->orderBy('id', $order_by);
    }

    /*=====================End======================*/


    public static function insert(array $data)
    {
        try {
            $find_user = User::find($data['user_id']);
            $data['full_name'] = $find_user->getFullNameAttribute();

            if(isset($data['attachment'])) {
                $data['attachment'] = Helper::uploadFile($data['attachment'], Enum::TICKET_ATTACHMENT_DIR);
            }

            return self::create($data);

        } catch (Exception $e) {
            return false;
        }
    }

    public static function changeAssignee(self $ticket, array $data)
    {
        DB::beginTransaction();

        try {
            $assigner = User::getAuthUser();
            $data['assigned_by'] = $assigner->id;
            $data['assigned_by_name'] = $assigner->getFullNameAttribute();

            $assignee = User::find($data['assigned_to']);
            $data['assign_to_name'] = $assignee->getFullNameAttribute();

            $data['ticket_id'] = $ticket->id;
            TicketAssign::create($data);

            $ticket->update([
                'assign_to_id' => $data['assigned_to'],
            ]);
            DB::commit();

            return true;

        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public static function filterTable(string $status = null)
    {
        $authUser = User::getAuthUser();
        $authUserRole = $authUser->roles->first()->slug;
        $query = self::query();

        if($authUserRole != Enum::ROLE_ADMIN_SLUG) {
            $query->where('assign_to_id', $authUser->id);
        }

        if($status) {
            $query->where('status', $status);
        }

        return $query->get();
    }

    public static function countTicket()
    {
        $user = User::getAuthUser();
        $user_role = $user->roles->first()->slug;
        $query = self::select('status', DB::raw('count(*) as total'));

        if($user_role != Enum::ROLE_ADMIN_SLUG) {
            $query->where('assign_to_id', $user->id);
        }

        $data = $query->groupBy('status')->pluck('total', 'status')->toArray();

        $total = Enum::getTicketStatus();

        foreach($total as $key => $value) {
            $total[$key] = $data[$key] ?? 0;
        }

        return $total;
    }

    public static function getTicketById(int $id)
    {
        return self::where('user_id', $id)->orderBy('id', 'desc')->get();
    }

}
