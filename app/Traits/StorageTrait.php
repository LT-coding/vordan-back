<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait StorageTrait
{
    /**
     * Store the file and return its path.
     *
     * @param string $path
     * @param UploadedFile $file
     * @return string
     */
    public function storeFile(string $path, UploadedFile $file): string
    {
        $path = Storage::putFile('public/'.$path, $file);
        return str_replace('public', 'storage', $path);
    }

    /**
     * Remove the file from the Storage.
     *
     * @param string $filePath
     * @return void
     */
    public function deleteFile(string $filePath): void
    {
        $storagePath = str_replace('storage', 'public', $filePath);
        Storage::delete($storagePath);
    }
}
