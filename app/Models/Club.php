<?php

namespace App\Models;

use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slogan',
        'image',
        'cover_image',
        'description',
        'is_active',
        'operator_id'
    ];

    public $afterCommit = true;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'operator_id');
    }

    public function members(string $order_by = 'asc')
    {
        return $this->hasMany(ClubMember::class, 'club_id', 'id')->orderBy('id', $order_by);
    }

    public static function getAll()
    {
        return self::all();
    }

    public function getFeaturedImage()
    {
        $path = public_path($this->image);

        if($this->image && is_file($path) && file_exists($path)) {
            return asset($this->image);
        }

        return asset(Enum::NO_AVATAR_PATH);
    }

    public static function getByStatus(int $is_active)
    {
        return self::where('is_active', $is_active)->get();
    }

    public static function insert(array $data)
    {
        try {
            $data['operator_id'] = User::getAuthUser()->id;

            if (isset($data['image'])) {
                $data['image'] = Helper::uploadImage($data['image'], Enum::CLUB, 300, 400);
            }

            if (isset($data['cover_image'])) {
                $data['cover_image'] = Helper::uploadImage($data['cover_image'], Enum::CLUB, 300, 800);
            }

            return self::create($data);
        } catch (\Exception $e) {
            Helper::log($e);

            return false;
        }
    }

    public static function edit(self $committee, array $data)
    {
        try {
            if(isset($data['image'])) {
                $data['image'] = Helper::uploadImage($data['image'], Enum::CLUB, 300, 400);
            }

            if(isset($data['cover_image'])) {
                $data['cover_image'] = Helper::uploadImage($data['cover_image'], Enum::CLUB, 300, 800);
            }

            return $committee->update($data);
        } catch (\Exception $e) {
            Helper::log($e);

            return false;
        }
    }

    public static function deleteClub(self $club)
    {
        DB::beginTransaction();

        try {
            $club->members()->delete();
            $club->delete();
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }

    public function getLogoImage()
    {
        $path = public_path($this->logo_image);

        if($this->logo_image && is_file($this->logo_image) && file_exists($path)) {
            return asset($this->logo_image);
        } else {
            return asset(Enum::NO_IMAGE_PATH);
        }
    }

    public function getFullAddressAttribute()
    {
        $address = $this->address_line_1;

        if($this->address_line_2) {
            $address .= ', ' . $this->address_line_2;
        }

        if($this->suburb) {
            $address .= ', ' . $this->suburb;
        }
        $address .= ', ' . $this->city;

        if($this->state) {
            $address .= ', ' . $this->state;
        }
        $address .= ', ' . $this->post_code;
        $address .= ', ' . Helper::getCountryName($this->country);

        return $address;
    }
}
