<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_type',
        'title',
        'date',
        'amount',
        'notes',
        'created_by',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    // Insert/Create Expense
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

    // Update Expense
    public static function edit(self $expense, array $data)
    {
        DB::beginTransaction();

        try {

            $data['created_by'] = Auth::user()->id;

            $expense->update($data);

            DB::commit();

            return true;
        } catch(Exception $e) {
            DB::rollback();

            return false;
        }
    }
}
