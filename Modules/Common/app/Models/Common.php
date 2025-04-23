<?php

namespace Modules\Common\app\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Common extends Model
{
    public static array $rules = [];

    // Added Functions
    public static function boot()
    {
        parent::boot();
        // set some hidden/system filled attributes
        static::saving(function ($model) {
            if (empty($model->exists)) {
                $model->created_by = Auth::id() ?? 1;
                $model->show_order = self::max('show_order') + 1;
            } else {
                $model->updated_by = Auth::id() ?? 1;
            }
        });
    }

    public function generateSlug($title, $slug, $slugField = '')
    {
        $slugField = empty($slugField) ? 'slug' : $slugField;
        $slug = empty($slug) ? $title : $slug;
        $uniqueSlug = $slug = generateSeoLinks($slug);
        $iteration = 0;
        while ($this->validateSlug($uniqueSlug, $slugField)) {
            $iteration++;
            $uniqueSlug = $this->generateUniqueSlug($slug, $iteration);
        }
        $this->$slugField = $uniqueSlug;
    }

    protected function generateUniqueSlug($baseSlug, $iteration)
    {
        return $baseSlug . '-' . ($iteration + 1);
    }

    // call this model to validate slug if the attributue name is not slug
    protected function validateSlug($slug, $slugField)
    {
        $tblName = $this->table;
        $primaryKey = $this->primaryKey;
        $rules = $this::$rules;

        $slugRule = $rules[$slugField] ?? 'unique:' . $tblName . ',' . $slugField;
        if ($this->$primaryKey) {
            $slugRule .= ',' . $this->$primaryKey . ',' . $primaryKey;
        }
        $validation = validator(
            [$slugField => $slug],
            [$slugField => $slugRule]
        );

        return $validation->fails();
    }
}
