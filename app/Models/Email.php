<?php

namespace App\Models;

use Throwable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'operator_id',
    ];

    /*=====================Eloquent Relations======================*/
    public function recipients()
    {
        return $this->hasMany(EmailRecipient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'operator_id');
    }
    /*=====================End Eloquent Relations======================*/

    public static function insert(array $emailData)
    {
        $formattedData = [];
        $emailData['operator_id'] = auth()->id();

        try {
            DB::beginTransaction();
            $email = self::create($emailData);

            foreach ($emailData['subscriber_id'] as $data) {

                $formattedData[] = [
                    'email_id'      => $email->id,
                    'subscriber_id' => $data,
                    'created_at'    => now(),
                ];
            }

            EmailRecipient::insert($formattedData);
            DB::commit();

            return true;
        } catch (Throwable $e) {
            DB::rollback();
            Log::info($e->getMessage());

            return false;
        }
    }
}
