<?php

namespace app\modules\translation\models;

use Yii;
use \app\modules\translation\models\base\Message as BaseMessage;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "message".
 * Modified by Defri Indra M
 */
class Message extends BaseMessage
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
