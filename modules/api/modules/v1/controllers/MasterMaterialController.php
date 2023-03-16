<?php

namespace app\modules\api\modules\v1\controllers;

/**
 * This is the class for REST controller "MasterMaterialController".
 * Modified by Defri Indra
 */

/**
 * This is the model class for table "t_master_material".
 *
 * @property int $id
 * @property string $nama
 * @property string $deskripsi
 * @property int $id_satuan
 * @property int $flag
 *
 * @property MasterSatuan $satuan
 * @property HargaMaterial[] $HargaMaterials
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Yii;

class MasterMaterialController extends \app\modules\api\controllers\BaseController
{
    use \app\traits\MessageTrait;
    public $modelClass = 'app\models\MasterMaterial';
    public $validation = null;

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

    public function verbs()
    {
        return [
            // 'index' => ['GET'],
            'view' => ['GET'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        // $this->validation = new \app\validations\Validation();
    }

    public function actionIndex()
    {
        $query = $this->modelClass::find();
        return $this->dataProvider($query);
    }

    public function actionCreate()
    {
        // \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // $model = new $this->modelClass;
        // $model->scenario = $model::SCENARIO_CREATE;
        // $model->attributes = \yii::$app->request->post();
        // if ($model->validate()) {
        //     $model->save();
        //     return array('status' => true, 'data' => 'Student record is successfully updated');
        // } else {
        //     return array('status' => false, 'data' => $model->getErrors());
        // }
        $model = new $this->modelClass;
        $model->scenario = $model::SCENARIO_CREATE;
        // var_dump($model);die;

        try {
            if ($model->load(\Yii::$app->request->post(), '')) {
                if ($model->validate()) {
                    $model->save();

                    return [
                        "success" => true,
                        "message" => $this->messageCreateSuccess(),
                    ];
                }

                throw new \yii\web\HttpException(422, $this->message422(\app\components\Constant::flattenError($model->getErrors())));
            }
            throw new \yii\web\HttpException(400, $this->message400());
        } catch (\Throwable $th) {
            if(YII_DEBUG) throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
            else  throw new \yii\web\HttpException($th->statusCode ?? 500, $this->message500());
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_UPDATE;

        try {
            if ($model->load(\Yii::$app->request->post(), '')) {
                if ($model->validate()) {
                    $model->save();

                    return [
                        "success" => true,
                        "message" => $this->messageUpdateSuccess(),
                    ];
                }

                throw new \yii\web\HttpException(
                    422,
                    $this->message422(
                        \app\components\Constant::flattenError(
                            $model->getErrors()
                        )
                    )
                );
            }
            throw new \yii\web\HttpException(400, $this->message400());
        } catch (\Throwable $th) {
            if (YII_DEBUG) throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
            else  throw new \yii\web\HttpException($th->statusCode ?? 500, $this->message500());
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        try {
            $model->delete();
            return [
                "success" => true,
                "message" => $this->messageDeleteSuccess()
            ];
        } catch (\Throwable $th) {
            if (YII_DEBUG) throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
            else  throw new \yii\web\HttpException($th->statusCode ?? 500, $this->message500());
        }
    }
}
