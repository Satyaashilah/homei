<?php

namespace app\modules\api\modules\v1\controllers;

/**
 * This is the class for REST controller "SupplierBarangController".
 * Modified by Defri Indra
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\debug\models\timeline\DataProvider;
use app\components\Constant;
use app\models\SupplierMaterial;
use app\models\SupplierOrderCart;
use app\models\SupplierSubMaterial;
use yii\web\HttpException;

class SupplierBarangController extends \app\modules\api\controllers\BaseController
{
    use \app\traits\MessageTrait;
    public $modelClass = 'app\models\SupplierBarang';
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
            'index' => ['GET'],
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
    public function actionFilter()
    {
        return [
            "material" => SupplierMaterial::find()->select('id,nama')->all(),
            // "sort" => [
            //     [
            //         "id" => 0,
            //         "nama" => "Default"
            //     ],
            //     [
            //         "id" => 1,
            //         "nama" => "Sortir dari yang termurah",
            //     ],
            //     [
            //         "id" => 2,
            //         "nama" => "Sortir dari yang termahal",
            //     ],
            // ]
        ];
    }

    public function actionIndex()
    {
        $query = $this->modelClass::find()->select([
            'id',
            'nama_barang',
            'supplier_id',
            'material_id',
            'stok',
            'harga_ritel',
            'harga_proyek',
            'minimal_beli_satuan',
            'minimal_beli_volume',
            'gambar'
        ]);
// kalo tanda q dihapus barang yang tampil jadi cuma sedikit, tapi kalo ga di hapus nanti fitur search nya ga fungsi alias nampilin seluruh data tanpa filter
        if ($search = Yii::$app->request->get('q')) {
            $query->andWhere(
                [
                    'like',
                    'nama_barang',
                    $search
                ]
            );
        }

        if ($material_id = Yii::$app->request->get('material_id')) {
            $material_id = explode(',', $material_id);
            // var_dump($material_id);die;/
            $query->andWhere(['in', 'material_id', $material_id]);
        }

        if ($submaterial_id = Yii::$app->request->get('submaterial_id')) {
            $submaterial_id = intval($submaterial_id);
            $query->andWhere(['submaterial_id' => $submaterial_id]);
        }

        if ($sort_id = Yii::$app->request->get('sort')) {
            $sort_id = intval($sort_id);
            if ($sort_id == 1) {
                $query->orderBy([
                    'harga_proyek' => SORT_ASC,
                ]);
            } else if ($sort_id == 2) {
                $query->orderBy([
                    'harga_proyek' => SORT_DESC,
                ]);
            } else if ($sort_id == 3) {
                $query->orderBy([
                    'created_at' => SORT_ASC,
                ]);
            } else if ($sort_id == 4) {
                $query->orderBy([
                    'created_at' => SORT_DESC,
                ]);
            } else {
                $query->orderBy(new \yii\db\Expression("rand()"));
            }
        } else {
            $query->orderBy(new \yii\db\Expression("rand()"));
        }

        return $this->dataProvider($query);
    }

    public function actionCreate()
    {
        $model = new $this->modelClass;
        $model->scenario = $model::SCENARIO_CREATE;

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
            if (YII_DEBUG) throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
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
