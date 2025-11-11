<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait FileManager
{
    public function saveFile($file, string $folder_path){
        $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($folder_path, $filename, 'public');
        return $path;
    }

    public function deleteFile($path){
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function replaceFile($oldFilePath, $newFile, string $folder_path){
        if ($oldFilePath) {
            $this->deleteFile($oldFilePath);
        }
        return $this->saveFile($newFile, $folder_path);
    }


}

