<?php

namespace app\helpers;

use Yii;

/**
 * FileHelper
 * @author  Defri Indra Mahardika < defrindr@gmail.com >
 */
class FileHelper
{
    public static function image($link, $html = true, $default = null)
    {
        $image = static::link($link);
        if ($image != null) {
            if ($html == false) {
                return $image;
            }
            return "<a  href='$image' target='_blank'><img src='$image' class='img img-response' style='width: 80px;'></a>";
        } else if ($html == false) {
            return ($default != null) ? $default : Yii::$app->params['app']['defaultImage'];
        } else if ($default != null) {
            return "<a  href='$default' target='_blank'><img src='$default' class='img img-response' style='width: 80px;'></a>";
        }

        return "<span  class='badge badge-warning'>Gambar tidak tersedia</span>";
    }

    public static function link($link, $default = false)
    {
        if (substr($link, 0, 4) == "http") {
            return $link;
        }

        $file = Yii::getAlias("@file/$link");
        if (static::checkFile($link)) {
            return $file;
        }

        if ($default) {
            return Yii::$app->params['app']['defaultImage'];
        }

        return null;
    }

    public static function download($link)
    {
        if ($absolutelink = static::link($link)) {
            return "<a href='$absolutelink' class='btn btn-primary' target='_blank'>Download</a>";
        }

        return "<span  class='badge badge-warning'>File tidak tersedia</span>";
    }


    public static function checkFile($filename)
    {
        $folder_path = Yii::getAlias("@webroot/uploads/");
        $default = Yii::getAlias("@webroot/uploads/default.png");
        $real_path = Yii::getAlias("@webroot/uploads/$filename");
        $existing_file = file_exists($real_path);

        if ($existing_file) {
            if ($folder_path != $real_path && $real_path != $default) {
                return true;
            }
        }

        return false;
    }
}
