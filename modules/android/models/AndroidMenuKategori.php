<?php

namespace app\modules\android\models;

use Yii;
use \app\modules\android\models\base\AndroidMenuKategori as BaseAndroidMenuKategori;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "android_menu_kategori".
 * Modified by Defri Indra M
 */
class AndroidMenuKategori extends BaseAndroidMenuKategori
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
