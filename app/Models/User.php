<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Exception;
use App\Library\Enum;
use App\Library\Helper;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Vite;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasPermissionsTrait;
    use SoftDeletes;

    protected $fillable = [
        'f_name',
        'm_name',
        'l_name',
        'email',
        'mobile',
        'password',
        'user_type',
        'status',
        'avatar',
        'dob',
        'job_type',
        'operator_id',
        'email_verified_at',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status'            => 'integer'
    ];

    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public $afterCommit = true;

    public function membership()
    {
        return $this->hasOne(MembershipPlan::class, 'id', 'membership_id');
    }

    public function userProfile()
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }

    public function getFullNameAttribute()
    {
        $name = $this->f_name;

        if ($this->m_name) {
            $name .= ' ' . $this->m_name;
        }
        $name .= ' ' . $this->l_name;

        return $name;
    }

    public function getAvatar(): string
    {
        $path = public_path($this->avatar);

        if ($this->avatar && is_file($path) && file_exists($path)) {
            return asset($this->avatar);
        }

        return Vite::asset(Enum::NO_AVATAR_PATH);
    }

    public function getPhotoId()
    {
        $path = public_path($this->photo_id);

        if ($this->photo_id && is_file($path) && file_exists($path)) {
            return asset($this->photo_id);
        }

        return asset(Enum::NO_AVATAR_PATH);
    }

    public function getDocuments()
    {
        $path = public_path($this->documents);

        if ($this->documents && is_file($path) && file_exists($path)) {
            return asset($this->documents);
        }

        return asset(Enum::NO_AVATAR_PATH);
    }

    public static function getAuthProfileImage()
    {
        $user = User::getAuthUser();

        if ($user) {
            $path = public_path($user->profile_image);

            if ($user->profile_image && is_file($path) && file_exists($path)) {
                return Vite::asset($user->profile_image);
            }
        }

        return Vite::asset(Enum::NO_AVATAR_PATH);
    }

    public function getFullAddressAttribute()
    {
        $address = $this->userProfile?->address;
        $address .= ', ' . $this->userProfile?->suburb;
        $address .= ', ' . $this->userProfile?->city;
        $address .= ', ' . $this->userProfile?->state;
        $address .= ', ' . $this->userProfile?->post_code;
        $address .= ', ' . Helper::getCountryName($this->userProfile?->country);

        return $address;
    }
    //Custom Functions
    public static function getAuthUser()
    {
        return auth()->user();
    }

    public static function getAll()
    {
        return self::all();
    }

    public static function getByStatus(int $status)
    {
        return User::where('user_type', Enum::USER_TYPE_MEMBER)
            ->where('status', (string) $status)
            ->get();
    }

    public function role()
    {
        return $this->roles()->first();
    }

    public function isAdmin()
    {
        return $this->member_type == Enum::USER_TYPE_ADMIN;
    }

    public function isCommittee()
    {
        return $this->member_type == Enum::USER_TYPE_COMMITTEE;
    }

    public function isMember()
    {
        return $this->member_type == Enum::USER_TYPE_MEMBER;
    }

    public function isCommitteeMember()
    {
        return $this->hasMany(CommitteeMember::class, 'user_id', 'id');
    }

    public function isClubMember()
    {
        return $this->hasMany(ClubMember::class, 'user_id', 'id');
    }

    public function isTeamMember()
    {
        return $this->hasMany(TeamMember::class, 'user_id', 'id');
    }

    public static function getAuthUserRole()
    {
        return auth()->user()->roles()->first();
    }

    public static function getByMemberNotAdmin(string $user_type)
    {
        $query = User::select('users.*')
            ->where('user_type', '!=', $user_type)->where('status', Enum::USER_STATUS_ACTIVE);

        return $query->get();
    }

    public static function getByMember(string $user_type)
    {
        $query = User::select('users.*')
            ->where('user_type', $user_type)->where('status', '!=', (string) Enum::USER_STATUS_PENDING);

        return $query->get();
    }

    public static function getByCommittee(string $user_type)
    {
        $query = User::select('users.*')
            ->where('user_type', $user_type)->where('status', Enum::USER_STATUS_ACTIVE);

        return $query->get();
    }

    public static function scopeMemberNotInTeam($query, array $user_ids)
    {
        return $query->where('status', Enum::USER_STATUS_ACTIVE)
            ->whereNotIn('id', $user_ids);
    }

    public static function getByMemberType(string $membership_id, int $paginate = null)
    {
        $query = User::whereMembershipId($membership_id)->whereStatus('1')->whereNot('id', 1);

        if (isset($paginate)) {
            return $query->paginate($paginate);
        } else {
            return $query->get();
        }
    }

    public function shareableData()
    {
        return $this->hasOne(DataSharing::class);
    }

    // For Member Operation

    public static function filterTable(array $params)
    {
        $query = User::select('*');

        if (isset($params['is_deleted']) && $params['is_deleted'] == 1) {
            $query->onlyTrashed();
        } elseif (isset($params['status'])) {
            $query->where('status', $params['status']);
        }

        return $query->get()->skip(1);
    }

    public static function insert(array $data)
    {
        DB::beginTransaction();

        try {
            $user_data = $data['user'];
            $user_data['user_type'] = Enum::USER_TYPE_ADMIN;
            $user_data['password'] = bcrypt($user_data['password']);
            $user_data['operator_id'] = auth()->id();

            if (isset($user_data['mobile'])) {
                $user_data['mobile'] = $data['mobile'];
            }

            if (isset($user_data['avatar'])) {
                $user_data['avatar'] = Helper::uploadImage($user_data['avatar'], Enum::USER_PROFILE_IMAGE, 200, 200);
            }

            unset($data['user']);
            $user = User::create($user_data);

            $data['user_id'] = $user->id;
            UserProfile::create($data);

            if (isset($data['role_id'])) {
                $user->roles()->attach($data['role_id']);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }

    public static function edit(self $user, array $data)
    {
        DB::beginTransaction();

        try {
            $user_data = isset($data['user']) ? $data['user'] : [];

            if ($user_data) {
                $user_data['operator_id'] = $user->id;

                if (isset($user_data['mobile'])) {
                    $user_data['mobile'] = $data['mobile'];
                }
            }

            if (isset($user_data['avatar'])) {
                $user_data['avatar'] = Helper::uploadImage($user_data['avatar'], Enum::USER_PROFILE_IMAGE, 200, 200);
            }

            unset($data['user']);
            $user->update($user_data);

            if ($user->userProfile) {
                $user->userProfile->update($data);
            } else {
                $data['user_id'] = $user->id;
                UserProfile::create($data);
            }

            if (isset($data['role_id'])) {
                $user->roles()->detach();
                $user->roles()->attach($data['role_id']);
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            Helper::log($e);
            DB::rollback();

            return false;
        }
    }

    public static function filterUser(array $data)
    {
        $query = User::query();

        try {
            if (isset($data['f_name'])) {
                $query->where('f_name', 'like', '%' . $data['f_name'] . '%')->where('l_name', 'like', '%' . $data['l_name'] . '%')->where('mobile', 'like', '%' . $data['mobile'] . '%');
            }

            if (isset($data['email'])) {
                $query->where('email', 'like', '%' . $data['email'] . '%');
            }

            if (isset($data['member_id'])) {
                $query->where('unique_id', 'like', '%' . $data['member_id'] . '%');
            }

            return $query->first();
        } catch (Exception $e) {
            return false;
        }
    }

    // For Membership Status Report Filtering
    public static function filterTableForReport(array $params)
    {
        $date = isset($params['date']) ? date('Y-m-d', strtotime($params['date'])) : now();

        if (isset($params['status']) && $params['status'] != 4) {
            if ($params['status'] == Enum::USER_STATUS_ACTIVE) {
                $query = User::select('*')->where("status", $params['status'])->where('membership_expired_at', '>=', $date);
            } elseif ($params['status'] == Enum::USER_STATUS_INACTIVE) {
                $query = User::select('*')->where("status", $params['status'])->where('membership_expired_at', '<=', $date);
            } elseif ($params['status'] == Enum::USER_STATUS_PENDING) {
                $query = User::select('*')->where("status", $params['status'])->where('created_at', '<=', $date);
            }
        } else {
            $query = User::select('*')->where("status", $params['status']);
        }

        return $query->get();
    }

    // For Member Signup Report Filtering
    public static function filterTableForSignupReport(array $params)
    {
        $startDate = isset($params['startDate']) ? date('Y-m-d', strtotime($params['startDate'])) : date('Y-m-d', strtotime('1900-01-1'));
        $endDate = isset($params['endDate']) ? date('Y-m-d', strtotime($params['endDate'])) : now();

        if (isset($params['startDate']) || isset($params['endDate'])) {
            $query = User::select('*')->where('user_type', Enum::USER_TYPE_MEMBER)->whereIn('status', [1, 2])->where('signup_date', '>=', $startDate)->where('signup_date', '<=', $endDate);
        } else {
            $query = User::select('*')->where('status', '');
        }

        return $query->get();
    }
}
