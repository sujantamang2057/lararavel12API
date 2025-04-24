<?php

namespace Modules\Common\app\Components;

use Carbon\Carbon;
use File;
use Image;

class ImageUploadManager
{
    public static function processUploadedImage($file = null, $uploadImageFilePathTmp = null, $imageDimensionsTmp = null)
    {
        $imageFileName = null;

        $uploadImageFilePath = empty($uploadImageFilePathTmp) ? storage_path(UPLOAD_FILE_PATH) : $uploadImageFilePathTmp;
        $imageDimensions = empty($imageDimensionsTmp) ? json_decode(UPLOAD_FILE_DIMENSIONS, true) : $imageDimensionsTmp;
        if (!empty($file)) {
            // Check & CreateDir
            File::ensureDirectoryExists($uploadImageFilePath);

            // Use unique filename
            $imageFileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            // Save Original File
            $mainImage = Image::read($file)->save($uploadImageFilePath . DS . $imageFileName);

            // Loop to create multiple dimensions
            foreach ($imageDimensions as $row) {
                // Check & Create Sub-Folder
                $uploadImageFilePathSub = $uploadImageFilePath . DS . $row;
                File::ensureDirectoryExists($uploadImageFilePathSub);
                // Resize Image maintaining aspect ratio and save file
                $tmpImage = Image::read($file)->scaleDown($row)->save($uploadImageFilePathSub . DS . $imageFileName);
            }
        }

        return $imageFileName;
    }
}
