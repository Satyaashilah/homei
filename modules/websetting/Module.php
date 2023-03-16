<?php

namespace app\modules\websetting;

use app\traits\AccessBehaviorTrait;

class Module extends \yii\base\Module
{
    use AccessBehaviorTrait;

    public $controllerNamespace = 'app\modules\websetting\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}
