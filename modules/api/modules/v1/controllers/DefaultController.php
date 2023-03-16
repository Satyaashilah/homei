<?php

namespace app\modules\api\modules\v1\controllers;

use yii\web\HttpException;

class DefaultController extends \app\modules\android\controllers\api\v1\AndroidBannerController
{
    function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authentication']['except'] = [
            'index',
            'collection'
        ];

        return $behaviors;
    }
}
