<?php

namespace app\modules\websetting\models;

use Yii;
use \app\modules\websetting\models\base\WebConfig as BaseWebConfig;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "web_config".
 * Modified by Defri Indra M
 */
class WebConfig extends BaseWebConfig
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

    public function getActive()
    {
        if ($this->active == 0) return "Tidak Aktif";
        return "Aktif";
    }
}
