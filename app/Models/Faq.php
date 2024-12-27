<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Faq extends Model
{
    use HasFactory;
    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'operator_id',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }


    public static function getFaqById(int $id)
    {
        return self::where('created_by', $id)->orderBy('id', 'desc')->get();
    }

    // Insert/Create News
    public static function insert(array $data)
    {
        try {
            $data['operator_id'] = auth()->id();
            self::create($data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // Update News
    public static function edit(self $faq, array $data)
    {
        try {
            $data['operator_id'] = auth()->id();

            $faq->update($data);

            return true;
        } catch(Exception $e) {
            return false;
        }
    }

    // For Filtering
    public static function filterTable(array $params)
    {
        $query = self::select('*');

        if (isset($params['is_deleted']) && $params['is_deleted'] == 1) {
            $query->onlyTrashed();
        } elseif(isset($params['status'])) {
            $query->where('is_active', $params['status']);
        }

        return $query->get();
    }

}
