<?php

namespace app\modules\android\models;

use Yii;
use \app\modules\android\models\base\AndroidBanner as BaseAndroidBanner;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "android_banner".
 * Modified by Defri Indra M
 */
class AndroidBanner extends BaseAndroidBanner
{
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }

    public function getUploadedPath()
    {
        return 'android/banner';
    }

    public function getParams($type = "json")
    {
        if ($this->params) {
            $params = json_decode($this->params);
            if ($type == "json") {
                return $params;
            } else if ($type == "html") {
                $html = "";
                foreach ($params as $key => $value) {
                    $html .= "<b>$key</b> : $value<br>";
                }
                return $html;
            }
        }
        return null;
    }
}
