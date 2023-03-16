<?php

namespace app\traits;

use Throwable;
use Yii;
use yii\web\UploadedFile;

/**
 * UploadFileTrait
 *
 * @author Defri Indra Mahardika <defrindr@gmail.com>
 * @package app\traits
 */
trait UploadFileTrait
{
    /**
     * uploadImage
     * Upload & compress image
     * @param UploadedFile $file
     * @param string $upload_path Where image will be located
     * @param int $new_width New dimension width of image
     * @return object
     */
    public static function uploadImage(UploadedFile $file, $upload_path = "random", $new_width = 600)
    {
        $upload_path = trim($upload_path, "/");
        $jenis_konten = $file->type;

        if (preg_match("/image/", $jenis_konten)) {
            $realpath_dir = Yii::getAlias("@webroot/uploads/{$upload_path}/");
            if (file_exists($realpath_dir) == false) {
                mkdir($realpath_dir, 0777, true);
            }

            $file_sementara = $file->tempName;
            $exploded_name = explode(".", $file->name);
            $ext = end($exploded_name);

            $nama_file =  Yii::$app->security->generateRandomString(32) . ".{$ext}";
            $file_dipermanenkan = $realpath_dir . $nama_file;
            $filename = $file_sementara;
            $percent = 1;

            // jiplak resolusi
            // pendeteksian ini masih bisa lolos dgn teknik RGB
            $size = getimagesize($filename); //diambil dari file temp, bukan $_FILE['mime']
            $width = $size[0];
            $height = $size[1];
            $mime = $size['mime'];

            //jika butuh memperkecil gambar
            $new_width = $width * $percent;
            $new_height = $height * $percent;

            // patenkan width
            $new_width = 600;
            $new_height = $width == 0 ? 0 : $height * $new_width / $width;

            // buat gambar baru

            try {
                // check mime type
                if ($mime == "image/jpeg" || $mime == "image/jpg") {
                    $image_create_func = "imagecreatefromjpeg";
                    $image_save_func = "imagejpeg";
                } elseif ($mime == "image/png") {
                    $image_create_func = "imagecreatefrompng";
                    $image_save_func = "imagepng";
                } elseif ($mime == "image/gif") {
                    $image_create_func = "imagecreatefromgif";
                    $image_save_func = "imagegif";
                } else {
                    throw new \Exception("Unknown image type.");
                }

                $image = $image_create_func($filename);

                // check if image corrupted
                if ($image === false) {
                    throw new \Exception("Cannot read image.");
                }

                // resize $image with new dimensions
                $new_image = imagecreatetruecolor($new_width, $new_height);
                imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagedestroy($image); // free up memory

                $image_save_func($new_image, $file_dipermanenkan);
                imagedestroy($new_image); // free up memory
            } catch (Throwable $th) {
                return (object) [
                    "success" => false,
                    "message" => $th->getMessage(),
                ];
            }

            return (object) [
                "success" => true,
                "fileName" => "{$upload_path}/{$nama_file}",
            ];
        } else {
            // return static::uploadFile($file, $upload_path);
            return (object) [
                "success" => false,
                "message" => "Jenis file yang anda unggah bukan gambar.",
            ];
        }
    }


    /**
     * uploadFile
     * Upload file to server
     * @param UploadedFile $file
     * @param string $upload_path Where image will be located
     * @return object
     */
    public static function uploadFile($file, $upload_path = "random")
    {
        $upload_path = trim($upload_path, "/");
        $realpath_dir = Yii::getAlias("@webroot/uploads/{$upload_path}/");
        if (file_exists($realpath_dir) == false) {
            mkdir($realpath_dir, 0777, true);
        }

        $exploded_name = explode(".", $file->name);
        $extension_file = end($exploded_name);
        $nama_file = sha1(rand(0, 9999)) . ".{$extension_file}";

        $file->saveAs("{$realpath_dir}/{$nama_file}");
        return (object) [
            "success" => true,
            "fileName" => "{$upload_path}/{$nama_file}",
        ];
    }

    public static function deleteFile($filename)
    {
        try {
            if (static::checkFile($filename, true)) {
                $real_path = Yii::getAlias("@webroot/uploads/$filename");
                unlink($real_path);
                return true;
            }
        } catch (Throwable $th) {
            return false;
        }
    }

    /**
     * checkFile
     * Check if file exist on server
     * @param string $filename
     * @param bool $check_defaultImage Set true if you want to check if file is default image
     * @return bool true if file exist on server
     */
    public static function checkFile($filename, $check_defaultImage = false)
    {
        $folder_path = Yii::getAlias("@webroot/uploads/");
        $defaultImages = [
            $folder_path . "default.png",
        ];
        $real_path = $folder_path . $filename;
        $existing_file = file_exists($real_path);

        if ($existing_file) {
            if ($folder_path != $real_path) {
                if ($check_defaultImage) {
                    if (!in_array($real_path, $defaultImages)) {
                        return true;
                    }
                } else {
                    return true;
                }
            }
        }

        return false;
    }
}
