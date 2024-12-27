<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Career extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_type',
        'title',
        'company_name',
        'deadline',
        'location',
        'short_description',
        'description',
        'is_active',
        'operator_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'operator_id');
    }

    // For Filtering
    public static function filterTable(array $params)
    {
        $query = Career::select('*');

        if (isset($params['is_deleted']) && $params['is_deleted'] == 1) {
            $query->onlyTrashed();
        } elseif(isset($params['status'])) {
            $query->where('is_active', $params['status']);
        }

        return $query->get();
    }

    // Insert/Create Career
    public static function insert(array $data)
    {
        DB::beginTransaction();

        try {
            $data['operator_id'] = Auth::user()->id;

            self::create($data);
            DB::commit();

            return true;

        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    // Update Career
    public static function edit(self $blog, array $data)
    {
        DB::beginTransaction();

        try {
            $data['operator_id'] = Auth::user()->id;
            $blog->update($data);

            DB::commit();

            return true;
        } catch(Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public static function CareerPage(){
        return self::orderBy('id', 'desc')->get();
    }
}
