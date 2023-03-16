<?php

namespace app\traits;

use app\models\Action;
use yii\base\Module;

/**
 * AccessBehaviorTrait
 * @author Defri Indra Mahardika
 * 
 */
trait AccessBehaviorTrait
{
    public function behaviors()
    {

        if ($this instanceof Module) {
            $controller = \Yii::$app->controller;
        } else {
            $controller = $this;
        }

        if (substr($controller->id, 0, 3) == "api") {
            return parent::behaviors();
        }
        return Action::getAccess($controller->id, $controller->module->id);
    }
}
