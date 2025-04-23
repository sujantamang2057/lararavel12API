<?php

namespace Modules\Cms\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class NewsCategory extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'cms_news_category';

    protected $primaryKey = 'category_id';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'category_name',
        'slug',
        'parent_category_id',
        'show_order',
        'publish',
        'reserved',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected function casts()
    {
        return [
            'category_id' => 'integer',
            'category_name' => 'string',
            'slug' => 'string',
            'parent_category_id' => 'integer',
            'show_order' => 'integer',
            'publish' => 'integer',
            'reserved' => 'integer',
            'created_at' => 'datetime:Y-m-d H:i',
            'updated_at' => 'datetime:Y-m-d H:i',
            'deleted_at' => 'datetime:Y-m-d H:i',
        ];
    }

    public static function boot()
    {
        parent::boot();
        // set some hidden/system filled attributes
        static::saving(function ($model) {
            if (empty($model->exists)) {
                $model->created_by = Auth::id() ?? 1;
            } else {
                $model->updated_by = Auth::id() ?? 1;
            }
        });
    }
}
