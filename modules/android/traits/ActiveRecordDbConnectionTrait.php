<?php

namespace app\modules\android\traits;

trait ActiveRecordDbConnectionTrait
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }
}
