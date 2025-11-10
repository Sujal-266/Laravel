<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait FileManager
{
    public function saveFile($file, string $folder_path){
        $filename = Str::random(10);
        $extension = $file->getClientOriginalExtension();
        while (Storage::disk('public')->exists("{$folder_path}/{$filename}.{$extension}")) {
            $filename = Str::random(10);
        }
        Storage::disk('public')->put("{$folder_path}/{$filename}.{$extension}", file_get_contents($file->getRealPath()));
        $path = "{$folder_path}/{$filename}.{$extension}";
        return $path;
    }

    public function deleteFile($path){
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    public function replaceFile($oldFilePath, $newFile, string $folder_path){
        $this->deleteFile($oldFilePath);
        return $this->saveFile($newFile, $folder_path);
    }


}

