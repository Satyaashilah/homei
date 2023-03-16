<?php

namespace app\modules\websetting\traits;

trait ActiveRecordDbConnectionTrait
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }
}
