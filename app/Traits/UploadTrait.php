<?php

namespace App\Traits;
/*
Traits são pura e simplesmente para reuso de código, que pode nos auxiliar nos casos em que fatalmente
precisamos cair no comportamento de “copiar e colar” determinados trechos de códigos em diferentes classes
*/

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
