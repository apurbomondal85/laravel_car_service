<?php

namespace App\Models;

use App\Library\Enum;
use App\Library\Helper;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_type',
        'title',
        'short_description',
        'description',
        'featured_image',
        'status',
        'created_by',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function getFeaturedImage()
    {
        $path = public_path($this->featured_image);

        if($this->featured_image && is_file($path) && file_exists($path)) {
            return asset($this->featured_image);
        }

        return asset(Enum::NO_AVATAR_PATH);
    }

    public static function getBlogById(int $id)
    {
        return self::where('created_by', $id)->orderBy('id', 'desc')->get();
    }

    // For Filtering
    public static function filterTable(array $params, $type)
    {
        $query = Blog::select('*')->where('post_type', $type);

        if (isset($params['is_deleted']) && $params['is_deleted'] == 1) {
            $query->onlyTrashed();
        } elseif(isset($params['status'])) {
            $query->where('is_active', $params['status']);
        }

        return $query->get();
    }

    // Insert/Create Blog
    public static function insert(array $data)
    {
        DB::beginTransaction();

        try {

            $data['created_by'] = Auth::user()->id;

            if(isset($data['featured_image'])) {
                $data['featured_image'] = Helper::uploadImage($data['featured_image'], Enum::BLOG_FEATURE_IMAGE, 800, 500);
            }

            self::create($data);
            DB::commit();

            return true;

        } catch (Exception $e) {
            DB::rollback();

            return false;
        }
    }

    // Update Blog
    public static function edit(self $blog, array $data)
    {
        DB::beginTransaction();

        try {

            $data['created_by'] = Auth::user()->id;

            if(isset($data['featured_image'])) {
                $data['featured_image'] = Helper::uploadImage($data['featured_image'], Enum::BLOG_FEATURE_IMAGE, 800, 500);
            }

            $blog->update($data);

            DB::commit();

            return true;
        } catch(Exception $e) {
            DB::rollback();

            return false;
        }
    }

    public static function countBlogCategory()
    {
        $categories = [];
        $query = self::select('blog_type', DB::raw('count(*) as total'));
        $data = $query->groupBy('blog_type')->pluck('total', 'blog_type')->toArray();
        $total = Config::getDropdowns(Enum::CONFIG_DROPDOWN_BLOG_TYPE);

        foreach($total as $key => $value) {
            $categories[$value] = $data[$value] ?? 0;
        }

        return $categories;
    }
}
