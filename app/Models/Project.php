<?php

namespace App\Models;

use App\Library\Enum;
use Illuminate\Support\Facades\Vite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'slug',
        'name',
        'short_description',
        'description',
        'featured_image',
        'url',
        'date',
        'is_featured',
        'is_active',
        'operator_id',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function projectImages()
    {
        return $this->hasMany(ProjectImage::class, 'project_id');
    }


    public function getImage(): string
    {
        $path = public_path($this->featured_image);

        if ($this->featured_image && is_file($path) && file_exists($path)) {
            return asset($this->featured_image);
        }

        return Vite::asset(Enum::NO_IMAGE_PATH);
    }


    public function scopeCategory($query, $category)
    {
        return $query->where('slug', $category);
    }

    public function scopeActive($query)
    {
        return $query->whereIsActive(Enum::STATUS_ACTIVE);
    }

    public function scopeFeatured($query)
    {
        return $query->whereIsFeatured(true);
    }

    public static function getProjectByCategory($category)
    {
        return self::category($category)->active()->get();
    }
}
