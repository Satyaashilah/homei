<?php

namespace app\modules\android;

use app\traits\AccessBehaviorTrait;

class Module extends \yii\base\Module
{
    use AccessBehaviorTrait;

    public $controllerNamespace = 'app\modules\android\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
