<?php

namespace app\components;

use dmstr\helpers\Html;

class ModalButton
{
    public static function a($text, $url, $options)
    {
        $default = [];
        $options = array_merge($default, $options);
        $title = isset($options['title']) ? $options['title'] : 'Modal';
        $options["onclick"] = new \yii\web\JsExpression("openmodal( '" . \yii\helpers\Url::to($url) . "',  '$title')");

        return Html::button($text, $options);
    }
}
