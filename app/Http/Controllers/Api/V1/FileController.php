<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Traits\FileManager;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class FileController extends Controller{

    use FileManager;
    use ApiResponse;
    public function uploadFile(Request $request){
        $file_path = null;
        if($request->has('file')){
            $file_path = $this->saveFile($request->file('file'),'test');
        }
        return response()->json([
            'data' => Storage::url($file_path),
            'message' => __('messages.file_uploaded_successfully'),
            'status' => '1',
        ]);
    }

    public function fileDestroy(Request $request){
        $this->deleteFile($request->path);
        return response()->json([
            'message' => __('messages.file_deleted_successfully'),
            'status' => '1',
        ]);
    }
}
