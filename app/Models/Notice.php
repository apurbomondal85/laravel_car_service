<?php

namespace App\Models;

use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Notice extends Model
{
    use HasFactory;

    protected $fillable = [
        'notice_type',
        'title',
        'short_description',
        'description',
        'featured_image',
        'is_active',
        'created_by',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function getFeaturedImage()
    {
        $path = public_path($this->featured_image);

        if($this->featured_image && is_file($path) && file_exists($path)) {
            return asset($this->featured_image);
        }

        return asset(Enum::NO_AVATAR_PATH);
    }

    // For Filtering
    public static function filterTable(array $params)
    {
        $query = Notice::select('*');

        if(isset($params['status'])) {
            $query->where('is_active', $params['status']);
        }

        return $query->get();
    }

    // Insert/Create Notice
    public static function insert(array $data)
    {
        DB::beginTransaction();

        try {
            $data['created_by'] = Auth::user()->id;

            if(isset($data['featured_image'])) {
                $data['featured_image'] = Helper::uploadImage($data['featured_image'], Enum::NOTICE_FEATURE_IMAGE, 200, 200);
            }

            self::create($data);
            DB::commit();

            return true;

        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    // Update Notice
    public static function edit(self $notice, array $data)
    {
        DB::beginTransaction();

        try {

            $data['created_by'] = Auth::user()->id;

            if(isset($data['featured_image'])) {
                $data['featured_image'] = Helper::uploadImage($data['featured_image'], Enum::NOTICE_FEATURE_IMAGE, 200, 200);
            }

            $notice->update($data);

            DB::commit();

            return true;
        } catch(Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
