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
use app\models\SupplierBarang;
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
            "sort" => [
                [
                    "id" => 0,
                    "nama" => "Default"
                ],
                [
                    "id" => 1,
                    "nama" => "Sortir dari yang termurah",
                ],
                [
                    "id" => 2,
                    "nama" => "Sortir dari yang termahal",
                ],
            ]
        ];
    }

    public function actionIndex()
    {
        // $nama_barang = SupplierBarang::find();
        // $search = $this->find();
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
            'gambar',
            'deskripsi'
        ]);
       

        if ($search = Yii::$app->request->get('nama_barang')) {
            $query->Where(
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

    public function actionListKeranjang()
    {
        $user = Constant::getUser();
        return SupplierOrderCart::find()->where([
            'user_id' => $user->id,
        ])->all();
    }

    public function actionTambahKeranjang($id)
    {
        $user = Constant::getUser();
        $product = $this->findModel($id);
        $cart = SupplierOrderCart::findOne([
            'user_id' => $user->id,
            'supplier_barang_id' => $product->id
        ]);

        $jumlah = floatval(Yii::$app->request->post('jumlah'));
        $jumlah = ($jumlah == 0) ? 1 : $jumlah;

        try {
            if (!$cart) {
                if ($product->stok == 0) {
                    throw new HttpException(400, "Stok item tidak tersedia");
                }
                $new = new SupplierOrderCart();
                $new->kode_unik = Yii::$app->security->generateRandomString(30);
                $new->user_id = $user->id;
                $new->material_id = $product->material_id;
                $new->submaterial_id = $product->submaterial_id;
                $new->supplier_id = $product->supplier_id;
                $new->supplier_barang_id = $product->id;
                $new->jumlah = $jumlah;
                $new->harga_satuan = $product->harga_ritel;
                $new->subtotal = $new->jumlah * $product->harga_ritel;
                $new->valid_spk = 0; // bypass bonus
                if ($new->validate() == false) {
                    throw new HttpException(400, Constant::flattenError($new->getErrors()));
                }
                $new->save();
                return [
                    "success" => true,
                    "message" => Yii::t("cruds", "Berhasil menambahkan ke keranjang")
                ];
            } else {
                throw new HttpException(400, Yii::t("cruds", "Item ini telah ditambahkan sebelumnya"));
            }
        } catch (\Throwable $th) {
            throw new HttpException($th->statusCode ?? 500, $th->getMessage() ?? "Telah terjadi kesalahan");
        }
    }

    public function actionUpdateKeranjang($uniq, $type)
    {
        $user = Constant::getUser();
        $cart = $this->findModelKeranjang([
            'user_id' => $user->id,
            'kode_unik' => $uniq
        ]);

        if (Constant::isMethod(['post']) == false) {
            throw new HttpException(405, "Method tidak di izinkan");
        }

        try {
            if ($type == "tambah") {
                $cart->jumlah += 1;
            } else if ($type == "kurang") {
                $cart->jumlah -= 1;
            } else if ($type == "ubah") {
                $jumlah = floatval(Yii::$app->request->post('jumlah'));
                $jumlah = ($jumlah == 0) ? 1 : $jumlah;
                $cart->jumlah = $jumlah;
            } else {
                throw new HttpException(400, "Tipe operasi tidak tersedia");
            }

            if ($cart->jumlah <= 0) {
                $cart->delete();
                return ["success" => 200, "message" => "Item berhasil dihapus dari keranjang"];
            }

            if ($cart->jumlah >= $cart->supplierBarang->minimal_beli_satuan && $cart->valid_spk == 1) $harga = $cart->supplierBarang->harga_proyek;
            else  $harga = $cart->supplierBarang->harga_ritel;

            $cart->harga_satuan = $harga;
            $cart->subtotal = $cart->jumlah * $harga;
            if ($cart->validate() == false) {
                throw new HttpException(400, Constant::flattenError($cart->getErrors()));
            }

            $cart->save();
            return [
                "success" => true,
                "data" => $cart,
                "message" => Yii::t("cruds", "Berhasil ubah ke keranjang")
            ];
        } catch (\Throwable $th) {
            throw new HttpException($th->statusCode ?? 500, $th->getMessage() ?? "Telah terjadi kesalahan");
        }
    }

    public function actionHapusKeranjang($uniq)
    {
        $user = Constant::getUser();
        $cart = $this->findModelKeranjang([
            'user_id' => $user->id,
            'kode_unik' => $uniq
        ]);

        if (Constant::isMethod(['delete']) == false) {
            throw new HttpException(405, "Method tidak di izinkan");
        }

        try {
            $cart->delete();
        } catch (\Throwable $th) {
            throw new HttpException($th->statusCode ?? 500, $th->getMessage() ?? "Telah terjadi kesalahan");
        }
    }
}
