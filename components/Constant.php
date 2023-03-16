<?php

namespace app\components;

use Yii;

class Constant
{
    const ROLE_SA = 1;
    const ROLE_SALES = 2;
    const ROLE_ADMIN_DEPO = 3;

    const COLOR = [
        "purple",
        "green",
        "red",
        "blue",
        "yellow",
        "orange",
        "maroon",
        "black",
    ];

    public static function generateRandomColor()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

    public static function purifyPhone($phone)
    {
        if ($phone == "") {
            return null;
        }

        $remove_white_space = str_replace(" ", "", $phone);
        $filter_phone = str_replace("-", "", $remove_white_space);

        if (substr($filter_phone, 0, 2) === "08") {
            $phone = substr($filter_phone, 1);
            $phone = "62" . $phone;
        } else if (substr($filter_phone, 0, 2) === "+") {
            $phone = substr($filter_phone, 1);
        }

        return $phone;
    }

    private static function COLUMN_SWITCH_ROW($number)
    {
        switch ($number) {
            case 1:
                $row = 12;
                break;
            case 2:
                $row = 6;
                break;
            case 3:
                $row = 4;
                break;
            case 4:
                $row = 3;
                break;
            default:
                $row = 6;
                break;
        }
        return $row;
    }

    /**
     * Modify Field size
     * @param int $number number of column
     * @param boolean $withLabel Is Field rendering with label
     * @return array
     */
    public static function COLUMN($number = 2, $withLabel = true)
    {
        $row = self::COLUMN_SWITCH_ROW($number);

        if ($withLabel) {
            $template = '<div class="col-lg-12">
                        <div class="col-md-12">{label}</div>
                        {hint}
                        <div class="col-md-12">{input}{error}</div>
                    </div>';
        } else {
            $template = '<div class="col-lg-12">
                        <div class="col-md-12">{input}{error}</div>
                    </div>';
        }

        return [
            'template' => $template,
            'labelOptions' => ['class' => "control-label"],
            'hintOptions' => ['class' => 'col-md-12', "style" => "font-size: .8rem"],
            'options' => ['class' => "col-md-{$row}", 'style' => 'padding:0px;'],
        ];
    }

    public static function generateRandomString($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function flattenError($errors)
    {
        $flatten = [];

        foreach ($errors as $errorAttr) :
            foreach ($errorAttr as $error) :
                $flatten[] = "$error";
            endforeach;
        endforeach;

        if ($flatten == []) {
            return null;
        }

        return $flatten[0];
    }

    public static function isMethod($method)
    {
        if (gettype($method) == "array") {
            foreach ($method as $_m) {
                if (Yii::$app->request->method == strtoupper($_m)) {
                    return true;
                }
            }
        } else {
            if (Yii::$app->request->method == strtoupper($method)) {
                return true;
            }
        }
        return false;
    }

    public static function getUser()
    {
        return \Yii::$app->user->identity;
    }

    /**
     * get List Id from Model
     */
    public static function getIDs($model, $attribute = "id")
    {
        $list = [];
        foreach ($model as $_m) {
            if (gettype($_m) == "array") {
                $list[] = $_m[$attribute];
            } else {
                $list[] = $_m->$attribute;
            }
        }

        return $list;
    }

    /**
     * get Random data from array
     */
    public static function getRandomFrom($array)
    {
        return $array[array_rand($array)];
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
