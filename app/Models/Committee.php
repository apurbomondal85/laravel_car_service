<?php

namespace App\Models;

use App\Library\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'is_current',
        'status',
        'created_by'
    ];

    public $afterCommit = true;

    public function members(string $order_by = 'asc')
    {
        return $this->hasMany(CommitteeMember::class, 'committee_id', 'id')->orderBy('id', $order_by);
    }

    public static function getAll()
    {
        return self::all();
    }

    public static function getByStatus(string $status)
    {
        return self::where('status', $status)->get();
    }

    public static function getCurrentCommittee()
    {
        return self::where('is_current', 1)->first();
    }

    public static function insert(array $data)
    {
        // dd($data);
        try {
            $data['created_by'] = User::getAuthUser()->id;

            return self::create($data);
        } catch (\Exception $e) {
            Helper::log($e);

            return false;
        }
    }

    public static function edit(self $committee, array $data)
    {
        try {
            $data['created_by'] = User::getAuthUser()->id;

            return $committee->update($data);
        } catch (\Exception $e) {
            Helper::log($e);

            return false;
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
