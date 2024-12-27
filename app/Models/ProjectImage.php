<?php

namespace App\Models;

use App\Library\Enum;
use Illuminate\Support\Facades\Vite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'image',
        'operator_id',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


    public function getProjectImage(): string
    {
        $path = public_path($this->image);

        if ($this->image && is_file($path) && file_exists($path)) {
            return asset($this->image);
        }

        return Vite::asset(Enum::NO_IMAGE_PATH);
    }
}
