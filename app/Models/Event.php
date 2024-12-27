<?php

namespace App\Models;

use Exception;
use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_type',
        'title',
        'short_description',
        'description',
        'start',
        'end',
        'featured_image',
        'is_active',
        'operator_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'operator_id');
    }

    public function getFeaturedImage()
    {
        $path = public_path($this->featured_image);

        if($this->featured_image && is_file($path) && file_exists($path)) {
            return asset($this->featured_image);
        }

        return asset(Enum::NO_AVATAR_PATH);
    }

    public static function getAllEvents()
    {
        return self::select('*')->get();
    }


    // For Filtering
    public static function filterTable(array $params)
    {
        $query = Event::select('*');

        if(isset($params['status'])) {
            $query->where('is_active', $params['status']);
        }

        return $query->get();
    }

    // Insert/Create Event
    public static function insert(array $data)
    {
        DB::beginTransaction();

        try {
            $data['operator_id'] = Auth::user()->id;

            if(isset($data['featured_image'])) {
                $data['featured_image'] = Helper::uploadImage($data['featured_image'], Enum::EVENT_FEATURE_IMAGE, 200, 200);
            }

            self::create($data);
            DB::commit();

            return true;

        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    // Update Event
    public static function edit(self $event, array $data)
    {
        DB::beginTransaction();

        try {

            $data['operator_id'] = Auth::user()->id;

            if(isset($data['featured_image'])) {
                $data['featured_image'] = Helper::uploadImage($data['featured_image'], Enum::EVENT_FEATURE_IMAGE, 200, 200);
            }

            $event->update($data);

            DB::commit();

            return true;
        } catch(Exception $e) {
            DB::rollback();

            return false;
        }
    }



    public static function countEventType()
    {
        $types = [];
        $query = self::select('event_type', DB::raw('count(*) as total'));
        $data = $query->groupBy('event_type')->pluck('total', 'event_type')->toArray();
        $total = Config::getDropdowns(Enum::CONFIG_DROPDOWN_EVENT_TYPE);

        foreach($total as $key => $value) {
            $types[$value] = $data[$value] ?? 0;
        }

        return $types;
    }
}
