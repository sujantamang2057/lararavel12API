<?php

namespace Modules\Cms\app\Models\Api;

use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Common\app\Models\Common;

class Album extends Common
{
    use SoftDeletes;

    public $table = 'cms_album';

    protected $primaryKey = 'album_id';

    public $fillable = [
        'date',
        'title',
        'slug',
        'detail',
        'cover_image_id',
        'image_count',
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
            'title' => 'string',
            'slug' => 'string',
            'detail' => 'string',
            'created_at' => 'datetime:Y-m-d H:i',
            'updated_at' => 'datetime:Y-m-d H:i',
            'deleted_at' => 'datetime:Y-m-d H:i',
        ];
    }
}
