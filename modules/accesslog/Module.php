<?php

namespace app\modules\accesslog;

use app\traits\AccessBehaviorTrait;

class Module extends \yii\base\Module
{
    use AccessBehaviorTrait;

    public $controllerNamespace = 'app\modules\accesslog\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
