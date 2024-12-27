<?php

namespace App\Models;

use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommitteeMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'user_id',
        'designation',
        'image',
        'role_id',
        'vote',
        'created_by',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function roleGet()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public static function insert(Committee $committee, array $data)
    {
        DB::beginTransaction();

        try {
            $data['created_by'] = User::getAuthUser()->id;

            if (isset($data['image'])) {
                $data['image'] = Helper::uploadImage($data['image'], Enum::COMMITTEE_MEMBER, 600, 600);
            }
            $data['committee_id'] = $committee->id;

            self::create($data);

            $user = User::where('id', $data['user_id'])->first();

            if (isset($data['role_id'])) {
                $user->roles()->attach($data['role_id']);
                $user->update([
                    'user_type' => Enum::USER_TYPE_ADMIN,
                ]);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }

    public static function edit(self $member, array $data)
    {
        DB::beginTransaction();

        try {
            $user = User::where('id', $data['user_id'])->first();

            $data['created_by'] = User::getAuthUser()->id;

            if (isset($data['image'])) {
                $data['image'] = Helper::uploadImage($data['image'], Enum::COMMITTEE_MEMBER, 600, 600);
            }

            if ($member->role_id) {
                $user->roles()->detach();
                $user->update([
                    'user_type' => Enum::USER_TYPE_MEMBER,
                ]);
            }

            $member->update($data);

            if (isset($data['role_id'])) {
                $user->roles()->attach($data['role_id']);
                $user->update([
                    'user_type' => Enum::USER_TYPE_ADMIN,
                ]);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }

    public static function setCurrentCommittee(Committee $committee)
    {
        DB::beginTransaction();

        try {
            $currentCommittee = Committee::where('is_current', 1)->first();

            Committee::where('is_current', 1)->update(['is_current' => 0]);
            $committee->is_current = 1;
            $committee->save();

            if ($currentCommittee) {
                $findCommittee = Committee::where('id', $currentCommittee->id)->first();

                if ($findCommittee->is_current == 0) {

                    $committeeMembers = CommitteeMember::where('committee_id', $findCommittee->id)->where('role_id', '!=', null)->get();

                    foreach ($committeeMembers as $member) {
                        $user = User::where('id', $member->user_id)->first();

                        if ($member->role_id) {
                            $user->roles()->detach();
                            $user->update([
                                'user_type' => Enum::USER_TYPE_MEMBER,
                            ]);

                            $member->update([
                                'role_id' => null,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }

    public static function deleteCommitteeMember(CommitteeMember $member)
    {
        DB::beginTransaction();

        try {

            if ($member->role_id) {
                $user = User::whereId($member->user_id)->first();

                $user->roles()->detach();
                $user->update([
                    'user_type' => Enum::USER_TYPE_MEMBER,
                ]);
            }

            $member->delete();

            DB::commit();

            return true;
        } catch (\Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }
}
