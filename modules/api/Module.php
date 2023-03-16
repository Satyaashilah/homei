<?php

namespace app\modules\api;

use dmstr\web\traits\AccessBehaviorTrait;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\api\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
        $this->modules = [
            'v1' => [
                'class' => 'app\modules\api\modules\v1\Module',
            ],

        ];
    }
}
