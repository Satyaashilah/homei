<?php

namespace app\modules\translation\models;

use Yii;
use \app\modules\translation\models\base\SourceMessage as BaseSourceMessage;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "source_message".
 * Modified by Defri Indra M
 */
class SourceMessage extends BaseSourceMessage
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
