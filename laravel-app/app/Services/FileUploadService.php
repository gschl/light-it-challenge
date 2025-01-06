<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileUploadService
{

    public function uploadToPath(UploadedFile $file, string $path): string
    {
        return $file->store($path, 'public');
    }
}
