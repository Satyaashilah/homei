<?php

namespace app\modules\blog\controllers;

use Yii;

/**
 * This is the class for controller "KategoriController".
 * Modified by Defri Indra
 */
class KategoriController extends \app\modules\blog\controllers\base\KategoriController
{
    // action for selectize widget
    public function actionSelectize()
    {
        // disable schema
        Yii::$app->params['without_schema'] = true;


        // set response to json
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = \app\modules\blog\models\Kategori::find()
            ->select('id, nama_kategori as name')
            ->asArray()
            ->all();

        return $model;
    }
}
