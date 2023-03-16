<?php

namespace app\components\productive;

use app\models\Action;
use Yii;
use yii\web\Controller;

class DefaultActiveController extends Controller
{
    use \app\traits\MessageTrait;

    /**
     * RBAC filter
     */
    public function behaviors()
    {
        return Action::getAccess($this->id);
    }

    protected function getRenderMethod()
    {
        $render = "render";
        if (Yii::$app->request->isAjax) $render = "renderAjax";

        return $render;
    }

    protected function parseCatch($e)
    {
        return (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
    }
}
