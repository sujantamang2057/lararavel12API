<?php

namespace Modules\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Cms\Http\Controllers\CmsController;
use Modules\Cms\Models\Api\NewsCategory;
use Modules\Cms\Http\Resources\Api\NewsCategoryResource;
use Modules\Common\app\Components\FileStorageManager;
use Modules\Common\app\Components\ImageUploadManager;

class NewsCategoryController extends CmsController
{
    public function __construct()
    {
        // Initialize Image PATH & DIMENSION
        $this->imageFilePath = storage_path(NEWS_CATEGORY_FILE_PATH);
        $this->imageDimensions = json_decode(NEWS_CATEGORY_FILE_DIMENSIONS, true);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->get('page');
        $perPage = $request->get('limit', 10);

        return $this->successResponse(__('common::messages.retrieved', ['model' => __('cms::models/news_categories.plural')]),
            NewsCategoryResource::collection(NewsCategory::orderBy('show_order', 'DESC')->paginate($perPage))
        );
    }

    /**
     * Display a listing of the trashed page resource.
     */
    public function trashList(Request $request)
    {
        $perPage = $request->get('limit', MAX_PAGINATION_PER_PAGE_LOW);
        $newsCategory = NewsCategory::onlyTrashed()
            ->orderBy('show_order', 'DESC')
            ->paginate($perPage);

        return $this->successResponse('Trashed Data retrieved successfully', NewsCategoryResource::collection($newsCategory));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        // sanitize first
        $request = $this->__sanitize($request);

        // validation
        $this->__validate($request);

        $input = $request->all();

        $newsCategory = NewsCategory::create($input);

        // handle uploaded images
        $fieldName = 'cat_image';
        if ($request->file($fieldName)) {
            $imageName = $this->__handleUploadedImage($request->file($fieldName), $fieldName);
            $newsCategory->$fieldName = $imageName;
            $updateData = [$fieldName => $imageName];
            $newsCategory->update($updateData, $newsCategory->category_id);
            // $newsCategory->save();
        }

        $response = $this->successResponse(__('common::messages.saved', ['model' => __('cms::models/news_categories.singular')]), new NewsCategoryResource($newsCategory));

        return $response;
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $newsCategory = NewsCategory::find($id);

        if (is_null($newsCategory)) {
            return $this->failedResponse(__('cms::models/news_categories.singular') . ' ' . __('common::messages.not_found'));
        }

        return $this->successResponse(__('common::messages.retrieved', ['model' => __('cms::models/news_categories.singular')]), new NewsCategoryResource($newsCategory));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): JsonResponse
    {
        $newsCategory = NewsCategory::find($id);

        if (is_null($newsCategory)) {
            return $this->failedResponse(__('cms::models/news_categories.singular') . ' ' . __('common::messages.not_found'));
        }
        // save old data
        $catImagePre = $newsCategory->cat_image;

        // sanitize first
        $request = $this->__sanitize($request);

        // validation
        $this->__validate($request, $newsCategory->category_id);

        $newsCategory->update($request->all());

        // handle uploaded images
        $fieldName = 'cat_image';
        if ($request->file($fieldName)) {
            $imageName = $this->__handleUploadedImage($request->file($fieldName), $fieldName);
            $newsCategory->$fieldName = $imageName;
            $updateData = [$fieldName => $imageName];
            $newsCategory->update($updateData);
            // delete old image
            $this->__deleteImageFile($catImagePre);
        }

        $response = $this->successResponse(__('common::messages.updated', ['model' => __('cms::models/news_categories.singular')]), new NewsCategoryResource($newsCategory));

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $newsCategory = NewsCategory::find($id);

        if (is_null($newsCategory)) {
            return $this->failedResponse(__('cms::models/news_categories.singular') . ' ' . __('common::messages.not_found'));
        }

        if ($newsCategory->reserved == 1) {
            return $this->failedResponse(__('common::messages.cannot_delete_reserve_data'));
        }
        $newsCategory->delete();

        return $this->successResponse(__('common::messages.deleted', ['model' => __('cms::models/news_categories.singular')]));
    }

    // sanitize inputs
    private function __sanitize($request)
    {
        $publish = (int) $request->get('publish');
        $reserved = (int) $request->get('reserved');
        $request->merge([
            // 'category_name' => removeString($request->get('category_name'), json_decode(REPLACE_KEYWORDS_TITLE)),
            'publish' => $publish,
            'reserved' => $reserved,
        ]);

        return $request;
    }

    // validation
    private function __validate($request, $id = null)
    {
        $tmpModel = new NewsCategory;
        $tableName = $tmpModel->table;
        $primaryKey = 'category_id';
        $this->validate($request, [
            'category_name' => 'required|string|between:2,50|unique:' . $tableName . ',category_name,' . $id . ',' . $primaryKey,
            'slug' => 'required|string|between:2,50|unique:' . $tableName . ',slug,' . $id . ',' . $primaryKey,
            'parent_category_id' => 'nullable|numeric|exists:' . $tableName . ',' . $primaryKey,
            'publish' => 'required|numeric|between:1,2',
            'reserved' => 'required|numeric|between:1,2',
        ]);
    }

    // handle image file
    private function __handleUploadedImage($file, $fieldName)
    {
        $imageFileName = null;
        if (!empty($file)) {
            $imageFileName = ImageUploadManager::processUploadedImage($file, $this->imageFilePath, $this->imageDimensions);
        }

        return $imageFileName;
    }

    // delete image file
    private function __deleteImageFile($imageFile = null)
    {
        if (!empty($imageFile)) {
            FileStorageManager::deleteImageFile($imageFile, $this->imageFilePath, $this->imageDimensions);
        }
    }
}
