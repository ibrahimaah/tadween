<?php

namespace App\Services;

use Exception;

class ImgService
{

    /**
     * Store an image and return its path.
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $directory 
     */
    public function storeImage($image, $directory = 'public/images')
    {
        try {
            // Ensure the directory exists or create it
            if (!$image->isValid()) {
                throw new Exception("Invalid image file");
            }

            // Generate a unique file name
            $imageName = now()->timestamp . '_' . uniqid('image_', true) . '.' . $image->getClientOriginalExtension();

            // Move the image to the specified directory
            $image->move(public_path($directory), $imageName);

            // Check if the file exists
            $imagePath = $directory . '/' . $imageName;
            if (file_exists(public_path($imagePath))) {
                return ['code' => 1, 'data' => $imagePath];
            }

            throw new Exception("image wasn't stored successfully");
        } catch (Exception $ex) {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }

    /**
     * Delete an image if it exists.
     *
     * @param string $imagePath
     * @return array
     */
    public function deleteImage($imagePath)
    {
        try {
            // Ensure the file exists
            $filePath = public_path($imagePath);
            if (file_exists($filePath)) 
            {
                // Delete the file
                unlink($filePath);
            }

            return ['code' => 1, 'data' => true];
            
        } catch (Exception $ex) {
            return ['code' => 0, 'msg' => $ex->getMessage()];
        }
    }
}
