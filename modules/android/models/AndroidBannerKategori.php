<?php

namespace app\modules\android\models;

use Yii;
use \app\modules\android\models\base\AndroidBannerKategori as BaseAndroidBannerKategori;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "android_banner_kategori".
 * Modified by Defri Indra M
 */
class AndroidBannerKategori extends BaseAndroidBannerKategori
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
    
}
