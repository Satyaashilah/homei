<?php

namespace app\modules\notification;

use app\traits\AccessBehaviorTrait;

class Module extends \yii\base\Module
{
    use AccessBehaviorTrait;

    public $controllerNamespace = 'app\modules\notification\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
