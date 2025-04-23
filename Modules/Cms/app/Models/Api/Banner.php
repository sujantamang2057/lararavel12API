<?php

namespace Modules\Cms\app\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\CmsAdmin\Database\Factories\Api/BannerFactory;

class Banner extends Model
{
    use HasFactory;
    public $table = 'cms_banner';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): Api/BannerFactory
    // {
    //     // return Api/BannerFactory::new();
    // }
}
