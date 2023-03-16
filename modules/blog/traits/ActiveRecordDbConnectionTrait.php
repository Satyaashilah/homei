<?php

namespace app\modules\blog\traits;

trait ActiveRecordDbConnectionTrait
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }
}
