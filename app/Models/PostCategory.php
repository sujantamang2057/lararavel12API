<?php


namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\app\Models\Common;

class PostCategory extends Common
{
    use SoftDeletes;

    public $table = 'cms_post_category';

    public $primaryKey = 'category_id';

    public $fillable = [
        'category_name',
        'slug',
        'parent_category_id',
        'category_image',
        'remarks',
        'show_order',
        'publish',
        'reserved',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $casts = [
        'category_name' => 'string',
        'slug' => 'string',
    ];

    public static array $rules = [
        'category_name' => 'required|string|max:191|unique:cms_post_category,category_name',
        'slug' => 'nullable|string|max:191|unique:cms_post_category,slug',
        'parent_category_id' => 'nullable|exists:cms_post_category,category_id',
        'category_image' => 'nullable|string|max:100',
        'remarks' => 'nullable|string|max:255',
        'publish' => 'required|integer|min:1|max:2',
        'reserved' => 'required|integer|min:1|max:2',
    ];

 
}
