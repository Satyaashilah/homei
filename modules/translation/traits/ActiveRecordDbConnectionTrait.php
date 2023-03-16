<?php

namespace app\modules\translation\traits;

trait ActiveRecordDbConnectionTrait
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }
}
