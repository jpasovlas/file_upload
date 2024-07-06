<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileTrait
{
    /**
     * Delete specific file in "public" disk
     *
     * @param string $file
     */
    public function deleteFile(string $file)
    {
        Storage::disk('public')->delete($file);
    }
}
