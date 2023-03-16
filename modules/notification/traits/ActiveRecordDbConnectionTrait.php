<?php

namespace app\modules\notification\traits;

trait ActiveRecordDbConnectionTrait
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }
}
