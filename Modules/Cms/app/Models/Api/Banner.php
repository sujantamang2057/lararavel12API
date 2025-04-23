<?php

namespace Modules\Cms\app\Models\Api;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\app\Models\Common;

// use Modules\Cms\Database\Factories\Api/BannerFactory;

class Banner extends Common
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    use SoftDeletes;

    public $table = 'cms_banner';

    protected $primaryKey = 'banner_id';

    public $fillable = [
        'title',
        'description',
        'pc_image',
        'sp_image',
        'url',
        'url_target',
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
            'description' => 'string',
            'pc_image' => 'string',
            'sp_image' => 'string',
            'url' => 'string',
            'url_target' => 'integer',
            'publish' => 'integer',
            'reserved' => 'integer',
            'created_at' => 'datetime:Y-m-d H:i',
            'updated_at' => 'datetime:Y-m-d H:i',
            'deleted_at' => 'datetime:Y-m-d H:i',
        ];
    }
}
