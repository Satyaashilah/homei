<?php

namespace app\modules\android\controllers;

use app\components\annex\ActiveForm;
use app\components\Constant;
use app\modules\android\models\AndroidBanner;
use app\modules\android\models\AndroidRoute;

/**
 * This is the class for controller "AndroidBannerController".
 * Modified by Defri Indra
 */
class AndroidBannerController extends \app\modules\android\controllers\base\AndroidBannerController
{
    function getParameter($id)
    {
        $model = AndroidRoute::findOne(['id' => $id]);
        if ($model == null) {
            return [];
        }

        if ($model->params == "") return [];
        $params = explode(",", $model->params);
        return $params;
    }

    function actionGetParameter($id, $banner = null)
    {
        $params = $this->getParameter($id);

        $modelBanner = AndroidBanner::findOne(['id' => $banner]);
        if ($modelBanner == null) $modelBanner = new AndroidBanner();

        $form = ActiveForm::begin([
            'id' => 'AndroidBanner',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error'
        ]);

        return $this->renderPartial('_form_params', ['params' => $params, 'model' => $modelBanner, 'form' => $form]);
    }
}
