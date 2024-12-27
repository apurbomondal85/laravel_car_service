<?php

namespace App\Models;

use App\Library\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'user_id',
        'user_type',
        'designation',
        'note',
        'created_by'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function insert(Club $club, array $data)
    {
        try {
            $data['created_by'] = User::getAuthUser()->id;
            $data['club_id'] = $club->id;

            return self::create($data);
        } catch (\Exception $e) {
            Helper::log($e);

            return false;
        }
    }

    public static function edit(self $member, array $data)
    {
        try {
            $data['created_by'] = User::getAuthUser()->id;

            return $member->update($data);
        } catch (\Exception $e) {
            Helper::log($e);

            return false;
        }
    }
}
