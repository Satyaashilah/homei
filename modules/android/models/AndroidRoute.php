<?php

namespace app\modules\android\models;

use Yii;
use \app\modules\android\models\base\AndroidRoute as BaseAndroidRoute;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "android_route".
 * Modified by Defri Indra M
 */
class AndroidRoute extends BaseAndroidRoute
{
    public static function getButuhLoginStatuses()
    {
        return [
            '0' => Yii::t("models", 'Tidak'),
            '1' => Yii::t("models", 'Ya'),
        ];
    }
}
