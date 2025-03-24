<?php

namespace App\Http\Traits;

trait UploadFileTrait
{
    protected function uploadFile($path, $file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '-' . rand(0000, 9999) . '.' . $extension;
        $path .= '/' . $fileName;
        $fullPath = public_path($path);

        $fileDir = dirname($fullPath);
        if (!file_exists($fileDir)) {
            mkdir($fileDir, 0777, true);
        }

        if (in_array($extension, ['jpg', 'jpeg', 'png'])) {
            $this->handleCompress($file, $fullPath, $extension);
        } else {
            $file->move(public_path($path), $fileName);
        }

        return $path;
    }

    private function handleCompress($file, $fullPath, $extension)
    {
        if ($extension == 'jpg' || $extension == 'jpeg') {
            $image = imagecreatefromjpeg($file->getPathname());
            imagejpeg($image, $fullPath, 50);
        } elseif ($extension == 'png') {
            $image = imagecreatefrompng($file->getPathname());
            imagepng($image, $fullPath, 5);
        }
        if ($image) {
            imagedestroy($image);
        }
    }
}
