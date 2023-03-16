<?php
namespace app\controllers\api;
use yii\rest\Controller;
use app\models\WilayahKota;
use app\models\WilayahProvinsi;
use Yii;

/**
 * WilayahKotaController implements the CRUD actions for WilayahKota model.
 */
class WilayahProvinsiController extends Controller
{
    public $modelClass = "\app\models\WilayahProvinsi";
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
        $data = \app\models\WilayahProvinsi::find();
        $nama = \Yii::$app->request->get('nama');
        $field = \Yii::$app->request->get('field');

        if($nama) {
            $data = $data->andWhere(['like','nama',$nama])->limit(1);
        } else {
            return [
                "success" => false,
                "message" => "Parameter :nama must be set"
            ];
        }

        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = [''];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }else {
            $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="wilayah_provinsi" and COLUMN_NAME')->queryAll();
            $includes = [];
            foreach($data_columns as $item) {
                $includes[] = $item['COLUMN_NAME'];
            }
            $data=$data->select($includes);
        }
        $result = $data->all();

        if(count($result) == 0) {
            return [
                "success" => false,
                "message" => "Data not found : nama -> $nama"
            ];
        }
        
        return [
            "data"=>$result
        ];
    }

    public function actionPost() {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $data = new WilayahProvinsi();
        $data->scenario = WilayahProvinsi::SCENARIO_CREATE;
        $data->attributes = \yii::$app->request->post();
        if($data->validate())
        {
         $data->save();
        //  var_dump($data->save());die;
         return array('status' => true, 'data'=> 'Data record is successfully created');
        }
        else
        {
         return array('status'=>false,'data'=>$data->getErrors());    
        }
      }
  
      public function actionList()
      {
          $data = \app\models\WilayahProvinsi::find();
          $nama = \Yii::$app->request->get('nama');
          $field = \Yii::$app->request->get('field');
  
  
          if($nama) {
              $data = $data->andWhere(['like','nama',$nama]);
          } else {
              return [
                  "success" => false,
                  "message" => "Parameter :user nama must be set"
              ];
          }
  
  
          if ($field){
              $allowed_field = array_filter($field, function($item) {
                  $excludes = [''];
                  if(in_array($item, $excludes)) {
                      return false;
                  } 
                  return true;
              });
              $data=$data->select($allowed_field);
          }else {
              $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="wilayah_provinsi" and COLUMN_NAME')->queryAll();
              $includes = [];
              foreach($data_columns as $item) {
                  $includes[] = $item['COLUMN_NAME'];
              }
              $data=$data->select($includes);
          }
          $result = $data->all();
  
  
          if(count($result) == 0) {
              return [
                  "success" => false,
                  "message" => "Data not found : nama -> $nama"
              ];
          }
          return [
              "data"=>$result
          ];
      }
  
      public function actionUpdated(){
  
       Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON; 
       $attributes = \Yii::$app->request->post();
    //    var_dump($attributes);die;
       $data = WilayahProvinsi::find()->where(['id' => $attributes['id'] ])->one();
    //    var_dump($attributes['nama']);die;
        if($data)
        {
         $data->attributes = \yii::$app->request->post();
        //  var_dump($attributes);die;
         $data->save();
         return array('status' => true, 'data'=> 'Data Wilayah Kota record is updated successfully');
        
        }
      else
      {
         return array('status'=>false,'data'=> 'No Data Wilayah Kota Found');
      }
      }
  
      
      public function actionDeleted($nama){
        //   $data=\app\models\TSupplier::find()->where(['id_user'=>$id])->one();
          $data= \app\models\WilayahProvinsi::find()->where(['nama'=>$nama])->one();
        //   $harga = \app\models\TSupplier::deleteAll(['id_material' => $id]);
          if($data->delete()){
              return "Berhasil";
            }
      }

}
