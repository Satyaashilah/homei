<?php

namespace app\modules\websetting\models;

use Yii;
use \app\modules\websetting\models\base\WebConfigGroup as BaseWebConfigGroup;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "web_config_group".
 * Modified by Defri Indra M
 */
class WebConfigGroup extends BaseWebConfigGroup
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
