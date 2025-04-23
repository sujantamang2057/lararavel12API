<?php

namespace Modules\Cms\app\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        // $image_base_url = STORAGE_DIR_NAME . '/' . BANNER_FILE_DIR_NAME . '/';
        // $image_thumb_url = $image_base_url . '200/';

        $data = parent::toArray($request);
        // $data['sp_image_base_url'] = url($image_base_url);
        // $data['sp_image_url'] = (!empty($this->sp_image)) ? url($image_thumb_url . $this->sp_image) : null;
        // $data['pc_image_base_url'] = url($image_base_url);
        // $data['pc_image_url'] = (!empty($this->pc_image)) ? url($image_thumb_url . $this->pc_image) : null;
        // $data['url_target_text'] = (string) getListText(OPTIONS_URL_TARGET, $this->url_target);
        // $data['publish_text'] = (string) getPublishText($this->publish);
        // $data['reserved_text'] = (string) getReservedText($this->reserved);
        // $data['created_by_name'] = (string) getUserNameById($this->created_by);
        // $data['updated_by_name'] = (string) getUserNameById($this->updated_by);
        // $data['deleted_by_name'] = (string) getUserNameById($this->deleted_by);

        return $data;
    }
}
