<?php

namespace Modules\Cms\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Cms\Http\Controllers\CmsController;
use Modules\Cms\app\Http\Resources\Api\AlbumResource;
use Modules\Cms\app\Models\Api\Album;

class AlbumController extends CmsController
{
    public function __construct()
    {
        $this->commonLangFile = 'cms::models/common';
        $this->langFile = 'cms::models/albums';
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('limit', MAX_PAGINATION_PER_PAGE_LOW);
        $albums = Album::orderBy('show_order', 'DESC')->paginate($perPage);

        return $this->successResponse(__('common::messages.retrieved', ['model' => __($this->langFile . '.plural')]),
            AlbumResource::collection($albums));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request = $this->__sanitize($request);
        $this->__validate($request);
        $input = $request->all();

        $album = Album::create($input);

        return $this->successResponse(__('common::messages.saved', ['model' => __($this->langFile . '.singular')]), new AlbumResource($album));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $album = Album::find($id);
        if (is_null($album)) {
            return $this->failedResponse(__($this->langFile . '.singular') . ' ' . __('common::messages.not_found'));
        }

        return $this->successResponse(__('common::messages.retrieved', ['model' => __($this->langFile . '.singular')]), new AlbumResource($album));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $album = Album::find($id);
        if (is_null($album)) {
            return $this->failedResponse(__($this->langFile . '.singular') . ' ' . __('common::messages.not_found'));
        }

        // sanitize first
        $request = $this->__sanitize($request);
        $this->__validate($request, $album->album_id);
        $input = $request->all();

        $album->update($input);

        return $this->successResponse(__('common::messages.updated', ['model' => __($this->langFile . '.singular')]), new AlbumResource($album));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $album = Album::find($id);
        if (is_null($album)) {
            return $this->failedResponse(__($this->langFile . '.singular') . ' ' . __('common::messages.not_found'));
        }
        if ($album->reserved == 1) {
            return $this->failedResponse(__('common::messages.cannot_delete_reserve_data'));
        }

        $album->delete();

        return $this->successResponse(__('common::messages.deleted', ['model' => __($this->langFile . '.singular')]));
    }

    private function __sanitize($request)
    {
        $publish = (int) $request->get('publish');
        $request->merge([
            'title' => removeString($request->get('title'), json_decode(REPLACE_KEYWORDS_TITLE)),
            'publish' => $publish,
        ]);

        return $request;
    }

    private function __validate($request, $id = null)
    {
        $tmpModel = new Album;
        $tableName = $tmpModel->table;
        $primaryKey = $tmpModel->getKeyName();
        $messages = __('common::validation');
        $attributes1 = __($this->langFile . '.fields');
        $attributes2 = __($this->commonLangFile . '.fields');
        $attributes = $attributes1 + $attributes2;

        $rules = [
            'title' => 'required|string|max:255|unique:' . $tableName . ',title,' . $id . ',' . $primaryKey,
            'slug' => 'required|string|max:255|unique:' . $tableName . ',slug,' . $id . ',' . $primaryKey,
            'date' => 'required|date',
            'detail' => 'nullable|string|between: 5,200',
            'publish' => 'required|numeric|between:1,2',
            'reserved' => 'required|numeric|between:1,2',
        ];
         return $this->validate($request, $rules, $messages, $attributes);
    }
}
