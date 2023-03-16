<?php

namespace app\modules\translation;

use app\traits\AccessBehaviorTrait;

class Module extends \yii\base\Module
{
    use AccessBehaviorTrait;

    public $controllerNamespace = 'app\modules\translation\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
