<?php

namespace App\Traits;

trait UploadTrait
{
    private function imageUpload($files, $imageColumn = null)
    {

        $uploadedImages = [];

        if (is_array($files)) {
            foreach ($files as $file) {
                $uploadedImages[] = [$imageColumn => $file->store('products', 'public')];
            }
        } else {
            $uploadedImages = $files->store('logo', 'public');
        }

        return $uploadedImages;
    }
}
