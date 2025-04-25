<?php

namespace Modules\Cms\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CmsController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public $commonLangFile;

    public $langFile;

    public $imageFilePath;

    public $imageDimensions;

    public $fileUplodPath;

    public function successResponse($message = '', $data = [], $code = 200)
    {
        $responseArray = [
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($responseArray, $code);
    }

    public function failedResponse($message = '', $data = [], $code = 200)
    {
        $responseArray = [
            'status' => 'failed',
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($responseArray, $code);
    }
} 
                                