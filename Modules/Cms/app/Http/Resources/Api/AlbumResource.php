<?php

namespace Modules\Cms\app\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['publish_text'] = (string) getPublishText($this->publish);
        // $data['reserved_text'] = (string) getReservedText($this->reserved);
        // $data['created_by_name'] = (string) getUserNameById($this->created_by);  
        // $data['updated_by_name'] = (string) getUserNameById($this->updated_by);
        // $data['deleted_by_name'] = (string) getUserNameById($this->deleted_by);

        return $data;
    }
}
