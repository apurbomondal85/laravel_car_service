<?php

namespace App\Models;

use Exception;
use App\Library\Enum;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_description',
        'description',
        'featured_image',
        'is_featured',
        'is_active',
        'post_type',
        'link',
        'operator_id',
        'category',
        'tags',
    ];

    public function operator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'operator_id');
    }

    public function getFeaturedImage()
    {
        $path = public_path($this->featured_image);

        if ($this->featured_image && is_file($path) && file_exists($path)) {
            return asset($this->featured_image);
        }

        return asset(Enum::NO_IMAGE_PATH);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeIsFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeGetBlog($query)
    {
        return $query->where('post_type', Enum::POST_TYPE_BLOG)->isActive();
    }

    public static function getLandingPageBlog()
    {
        return self::isActive()->where('post_type', Enum::POST_TYPE_BLOG)->orderBy('id', 'desc')->get();
    }

    public static function getNewsById(int $id)
    {
        return self::where('created_by', $id)->orderBy('id', 'desc')->get();
    }

    // Insert/Create News
    public static function insert(array $data, string $type)
    {
        try {
            $data['operator_id'] = auth()->id();
            $data['post_type'] = $type;
            $data['tags'] = isset($data['tags']) ? json_encode($data['tags']) : null;

            if (isset($data['featured_image'])) {
                $data['featured_image'] = ($type == 'news') ?
                    Helper::uploadImage($data['featured_image'], Enum::NEWS_FEATURE_IMAGE, 1200, 800) :
                    Helper::uploadImage($data['featured_image'], Enum::BLOG_FEATURE_IMAGE, 1200, 800);
            }

            self::create($data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // Update News
    public static function edit(self $post, array $data)
    {
        try {
            $data['created_by'] = User::getAuthUser()->id;
            $data['tags'] = isset($data['tags']) ? json_encode($data['tags']) : null;

            if (isset($data['featured_image'])) {
                $data['featured_image'] = ($post->post_type == 'news') ?
                    Helper::uploadImage($data['featured_image'], Enum::NEWS_FEATURE_IMAGE, 800, 500) :
                    Helper::uploadImage($data['featured_image'], Enum::BLOG_FEATURE_IMAGE, 800, 500);
            }

            $post->update($data);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    // For Filtering
    public static function filterTable(array $params, string $type)
    {
        $query = self::select('*')->where('post_type', $type);

        if (isset($params['is_deleted']) && $params['is_deleted'] == 1) {
            $query->onlyTrashed();
        } elseif (isset($params['status'])) {
            $query->where('is_active', $params['status']);
        }

        return $query->get();
    }


    public static function countBlogCategory()
    {
        $categories = [];
        $query = self::where('post_type', Enum::POST_TYPE_BLOG)
                ->select('category', DB::raw('count(*) as total'));

        $data = $query->groupBy('category')->pluck('total', 'category')->toArray();
        $total = getDropdown(Enum::CONFIG_DROPDOWN_BLOG_TYPE);


        foreach($total as $key => $value) {
            $categories[$value] = $data[$value] ?? 0;
        }

        return $categories;
    }
}
