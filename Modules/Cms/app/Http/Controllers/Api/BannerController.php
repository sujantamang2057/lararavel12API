<?php

namespace Modules\Cms\app\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Cms\app\Http\Controllers\CmsController;
use Modules\Cms\app\Http\Resources\Api\BannerResource;
use Modules\Cms\app\Models\Api\Banner;
use Modules\Common\app\Components\FileStorageManager;
use Modules\Common\app\Components\ImageUploadManager;

class BannerController extends CmsController
{
    public function __construct()
    {
        $this->commonLangFile = 'cms::models/common';
        $this->langFile = 'cms::models/banners';
        // imagePath and Dimensions
        $this->imageFilePath = storage_path(BANNER_FILE_PATH);
        $this->imageDimensions = json_decode(BANNER_FILE_DIMENSIONS, true);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('limit', MAX_PAGINATION_PER_PAGE_LOW);
        $banners = Banner::orderBy('show_order', 'DESC')->paginate($perPage);

        return $this->successResponse(__('common::messages.retrieved', ['model' => __($this->langFile . '.plural')]), BannerResource::collection($banners));
    }

    /**
     * Display a trashed data of the resource.
     */
    public function trashList(Request $request)
    {
        $perPage = $request->get('limit', MAX_PAGINATION_PER_PAGE_LOW);
        $banners = Banner::onlyTrashed()->orderBy('show_order', 'DESC')->paginate($perPage);

        return $this->successResponse('Trashed Data retrieved Successfully', BannerResource::collection($banners));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request = $this->__sanitize($request);
        $this->__validate($request);
        $input = $request->all();

        $banner = Banner::create($input);

        $fieldName = 'pc_image';
        if (!empty($request->file($fieldName))) {
            $imageFile = $this->__handleUploadedImage($request->file($fieldName));
            $updatedData = [$fieldName => $imageFile];
            $banner->update($updatedData);
        }

        $fieldName1 = 'sp_image';
        if (!empty($request->file($fieldName1))) {
            $imageFile1 = $this->__handleUploadedImage($request->file($fieldName1));
            $updatedData1 = [$fieldName1 => $imageFile1];
            $banner->update($updatedData1);
        }

        return $this->successResponse(__('common::messages.saved', ['model' => __($this->langFile . '.singular')]), new BannerResource($banner));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
      
        $banner = Banner::find($id);
        if (is_null($banner)) {
            return $this->failedResponse(__($this->langFile . '.singular') . ' ' . __('common::messages.not_found'));
        }

        return $this->successResponse(__('common::messages.retrieved', ['model' => __($this->langFile . '.singular')]), new BannerResource($banner));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        if (is_null($banner)) {
            return $this->failedResponse(__($this->langFile . '.singular') . ' ' . __('common::messages.not_found'));
        }

        // save old image
        $pcImagePre = $banner->pc_image;
        $spImagePre = $banner->sp_image;

        $request = $this->__sanitize($request);
        $this->__validate($request, $banner->banner_id);
        $input = $request->all();

        $banner->update($input);

        $fieldName = 'pc_image';
        if (!empty($request->file($fieldName))) {
            $imageFile = $this->__handleUploadedImage($request->file($fieldName));
            $updatedData = [$fieldName => $imageFile];
            $banner->update($updatedData);

            $this->__deleteImageFile($pcImagePre);
        }

        $fieldName = 'sp_image';
        if (!empty($request->file($fieldName))) {
            $imageFile = $this->__handleUploadedImage($request->file($fieldName));
            $updatedData = [$fieldName => $imageFile];
            $banner->update($updatedData);

            $this->__deleteImageFile($spImagePre);
        }

        return $this->successResponse(__('common::messages.updated', ['model' => __($this->langFile . '.singular')]), new BannerResource($banner));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        if (is_null($banner)) {
            return $this->failedResponse(__($this->langFile . '.singular') . ' ' . __('common::messages.not_found'));
        }
        if ($banner->reserved == 1) {
            return $this->failedResponse(__('common::messages.cannot_delete_reserve_data'));
        }

        $banner->delete();

        $banner->update([
            'deleted_by' => auth()->user() ? auth()->user()->id : 1,
        ]);

        return $this->successResponse(__('common::messages.deleted', ['model' => __($this->langFile . '.singular')]));
    }

    // sanitize inputs
    private function __sanitize($request)
    {
        $publish = (int) $request->get('publish');
        $reserved = (int) $request->get('reserved');
        $request->merge([
            'title' => removeString($request->get('title'), json_decode(REPLACE_KEYWORDS_TITLE)),
            'publish' => $publish,
            'reserved' => $reserved,
        ]);

        return $request;
    }

    private function __validate($request, $id = null)
    {
        $tmpModel = new Banner;
        $tableName = $tmpModel->table;
        $primaryKey = $tmpModel->getKeyName();
        $messages = __('common::validation');
        $attributes1 = __($this->langFile . '.fields');
        $attributes2 = __($this->commonLangFile . '.fields');
        $attributes = $attributes1 + $attributes2;

        $rules = [
            'title' => 'required|string|between:2,191|unique:' . $tableName . ',title,' . $id . ',' . $primaryKey,
            'description' => 'nullable|string|max:300',
            'pc_image' => 'required',
            'sp_image' => 'nullable',
            'url' => 'nullable|string|url|max:255',
            'url_target' => 'required|numeric|min:1|max:2',
            'publish' => 'required|numeric|max:2|min:1',
            'reserved' => 'required|numeric|max:2|min:1',

        ];

        $this->validate($request, $rules, $messages, $attributes);
    }

    private function __handleUploadedImage($file)
    {
        $imageFileName = null;
        if (!empty($file)) {
            $imageFileName = ImageUploadManager::processUploadedImage($file, $this->imageFilePath, $this->imageDimensions);
        }

        return $imageFileName;
    }

    private function __deleteImageFile($imageFile = null)
    {
        if (!empty($imageFile)) {
            FileStorageManager::deleteImageFile($imageFile, $this->imageFilePath, $this->imageDimensions);
        }
    }
}
