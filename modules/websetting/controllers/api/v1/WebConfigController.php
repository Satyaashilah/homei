<?php

namespace app\modules\websetting\controllers\api\v1;

/**
 * This is the class for REST controller "WebConfigController".
 * Modified by Defri Indra
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

class WebConfigController extends \app\modules\api\controllers\BaseController
{
    public $modelClass = 'app\modules\websetting\models\WebConfig';

    /**
    * @inheritdoc
    */
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "except" => ["index", "view"]
        ];

        return $parent;
    }

    public function actionIndex(){
        $query = $this->modelClass::find();
        return $this->dataProvider($query);
    }

    public function actionCreate(){
        $model = new $this->modelClass;
        $model->scenario = $model::SCENARIO_CREATE;

        try {
            if ($model->load(\Yii::$app->request->post(), '')) {
                if ($model->validate()) {
                    $model->save();

                    return [
                        "success" => true,
                        "message" => "Data berhasil dihapus"
                    ];
                }

                throw new \yii\web\HttpException(422);
            }
            throw new \yii\web\HttpException(400);
        } catch (\Throwable $th) {
            throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
        }
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_UPDATE;

        try {
            if ($model->load(\Yii::$app->request->post(), '')) {
                if ($model->validate()) {
                    $model->save();

                    return [
                        "success" => true,
                        "message" => "Data berhasil dihapus"
                    ];
                }

                throw new \yii\web\HttpException(422);
            }
            throw new \yii\web\HttpException(400);
        } catch (\Throwable $th) {
            throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
        }
    }

    public function actionDelete($id){
        $model = $this->findModel($id);

        try {
            $model->delete();
            return [
                "success" => true,
                "message" => "Data berhasil dihapus"
            ];
        } catch (\Throwable $th) {
            throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
        }
    }
}
