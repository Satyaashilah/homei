<?php
namespace app\controllers\api;
use yii\rest\Controller;
use Yii;

/**
 * CartController implements the CRUD actions for Cart model.
 */
class CartController extends Controller
{
   
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'only' => ['index', 'view', 'list','updated', 'post', 'deleted'],
                'formats' => [
                'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
            ];
    }

    public function actionIndex() {
        return [
            "success" => true,
        ];
    }

    public function actionView() {
        $data = \app\models\TSupplierOrderCart::find()
        ->innerJoinWith('supplierBarang')
        ->select(['jumlah', 'volume', 'harga_satuan', 'subtotal', 't_supplier_barang.*']);
        $nama_barang = \Yii::$app->request->get('nama_barang');
        $field = \Yii::$app->request->get('field');

        if($nama_barang) {
            $data = $data->andWhere(['like','nama_barang',$nama_barang])->limit(1);
        } else {
            return [
                "success" => false,
                "message" => "Parameter :nama barang must be set"
            ];
        }

        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = ['id'];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }$result = $data->asArray()->all();

        if(count($result) == 0) {
            return [
                "success" => false,
                "message" => "Data not found : nama barang -> $nama_barang"
            ];
        }
        
        return [
            "data"=>$result
        ];
    }
  
    public function actionList()
    {
        $data = \app\models\TSupplierOrderCart::find()
        ->innerJoinWith('supplierBarang')
        ->select(['jumlah', 'volume', 'harga_satuan', 'subtotal', 't_supplier_barang.*']);
        $nama_barang = \Yii::$app->request->get('nama_barang');
        $field = \Yii::$app->request->get('field');


        if($nama_barang) {
            $data = $data->andWhere(['like','nama_barang',$nama_barang]);
        } else {
            return [
                "success" => false,
                "message" => "Parameter :user nama must be set"
            ];
        }
  
  
        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = ['id'];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }$result = $data->all();
  
  
        if(count($result) == 0) {
            return [
                "success" => false,
                "message" => "Data not found : nama -> $nama_barang"
            ];
        }
        return [
            "data"=>$result
        ];
    }

    public function actionUpdated(){

        Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON; 
        $id = \yii::$app->request->get('id');
        $data = \app\models\TSupplierOrderCart::find()
        ->andWhere(['id'=> $id])
        ->one();
       //  var_dump($data);die;
        if($data) {
            $data->attributes = \yii::$app->request->post();
            $data->save();
            return array('status' => true, 'data'=> 'Data Cart record is updated successfully');
        }else {
            return array('status'=>false,'data'=> 'No Cart Found');
        }
    }
  
    public function actionDeleted($nama_barang){
        //   $data=\app\models\TSupplier::find()->where(['id_user'=>$id])->one();
        $data= \app\models\TSupplierBarang::find()->where(['nama_barang'=>$nama_barang])->one();
        //   $harga = \app\models\TSupplier::deleteAll(['id_material' => $id]);
        if($data->delete()){
            return "Berhasil";
        }
    }

}
