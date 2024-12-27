<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'is_for_emp',
        'is_for_donor',
        'is_for_org',
        'message',
    ];
    /*=====================Eloquent======================*/
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    /*=====================End======================*/

    public static function filterTable(array $params)
    {
        $query = self::query();

        if(isset($params['is_for_emp'])) {
            $query->where('is_for_emp', 1);
        }

        if(isset($params['is_for_donor'])) {
            $query->where('is_for_donor', 1);
        }

        if(isset($params['is_for_org'])) {
            $query->where('is_for_org', 1);
        }

        return $query->get();
    }

    /*================ CRUD Operations ==================*/
    public static function insert(array $data)
    {
        try {
            return self::create($data);
        } catch (\Exception $e) {
            Helper::log($e);

            return false;
        }
    }
    /*=======================End=======================*/
}
