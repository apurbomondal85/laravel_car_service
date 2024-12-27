<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClubCommittee extends Model
{
    use HasFactory;

    protected $fillable = [
        'club_id',
        'user_id',
        'user_type',
        'designation',
        'note',
        'is_active',
        'created_by'
    ];


    // Eloquent Relation
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function member()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function club()
    {
        return $this->hasOne(User::class, 'id', 'club_id');
    }


    // Custom Function

    // Filtering Datatable
    public static function getClubMember($club_id)
    {
        $query = ClubCommittee::select('*')
            ->where('club_id', $club_id);

        return $query->get();
    }

    // Create/Insert Club Committee
    public static function insert(array $data)
    {
        DB::beginTransaction();

        try {
            $data['created_by'] = Auth::user()->id;

            self::create($data);
            DB::commit();

            return true;

        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    // Update/Edit ClubCommittee
    public static function edit(self $clubCommittee, array $data)
    {
        DB::beginTransaction();

        try {
            $data['created_by'] = Auth::user()->id;

            $clubCommittee->update($data);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();

            return false;
        }
    }
}
