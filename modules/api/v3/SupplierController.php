<?php
namespace app\controllers\api;
use yii\rest\Controller;
use app\models\TSupplier;
use Yii;

/**
 * SupplierController implements the CRUD actions for TSupplier model.
 */
class SupplierController extends Controller
{
    public $modelClass = "\app\models\TSupplier";
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \yii\ filters\ ContentNegotiator::className(),
                'only' => ['index', 'view', 'list','updated', 'post', 'deleted'],
                'formats' => [
                'application/json' => \yii\ web\ Response::FORMAT_JSON,
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
        $data = \app\models\TSupplier::find();
        $name = \Yii::$app->request->get('name');
        $field = \Yii::$app->request->get('field');
        
        

        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = ['latitude', 'longitude', 'created_at', 'deleted_at', 'created_by', 'updated_at', 'updated_by', 'deleted_by'];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }else {
            $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="t_supplier" and COLUMN_NAME not in ("latitude","longitude", "created_at", "deleted_at", "created_by", "updated_at", "updated_by", "deleted_by")')->queryAll();
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
                "message" => "Data not found : name -> $name"
            ];
        }
        
        // if($result == null) {
        //     return [
        //         "success" => false,
        //         "message" => "Data not found : name -> $name"
        //     ];
        // }
        return [
            "data"=>$result
        ];
    }

    public function actionPost() {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $data = new TSupplier();
        $data->scenario = TSupplier::SCENARIO_CREATE;
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
          $data = \app\models\TSupplier::find();
          $id = \Yii::$app->request->get('id');
          $field = \Yii::$app->request->get('field');
  
  
          if($id) {
              $data = $data->andWhere(['like','id',$id]);
          } else {
              return [
                  "success" => false,
                  "message" => "Parameter :user id must be set"
              ];
          }
  
  
          if ($field){
              $allowed_field = array_filter($field, function($item) {
                  $excludes = ['latitude', 'longitude', 'created_at', 'deleted_at', 'created_by', 'updated_at', 'updated_by', 'deleted_by'];
                  if(in_array($item, $excludes)) {
                      return false;
                  } 
                  return true;
              });
              $data=$data->select($allowed_field);
          }else {
              $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="t_supplier" and COLUMN_NAME not in ("latitude","longitude", "created_at", "deleted_at", "created_by", "updated_at", "updated_by", "deleted_by")')->queryAll();
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
                  "message" => "Data not found : id -> $id"
              ];
          }
          return [
              "data"=>$result
          ];
      }
  
      public function actionUpdated(){
  
       Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON; 
       $attributes = \yii::$app->request->post();
       var_dump($attributes);die;
       $data = TSupplier::find()->where(['nama_supplier' => $attributes['nama_supplier'] ])->one();
    //    var_dump($attributes);die;
        if($data)
        {
         $data->attributes = \yii::$app->request->post();
        //  var_dump($attributes);die;
        //  $data->save();
         return array('status' => true, 'data'=> 'Data Supplier record is updated successfully');
        
        }
      else
      {
         return array('status'=>false,'data'=> 'No Data Supplier Found');
      }
      }
  
      
      public function actionDeleted($nama_supplier){
        //   $data=\app\models\TSupplier::find()->where(['id_user'=>$id])->one();
          $data= \app\models\TSupplier::find()->where(['nama_supplier'=>$nama_supplier])->one();
        //   $harga = \app\models\TSupplier::deleteAll(['id_material' => $id]);
          if($data->delete()){
              return "Berhasil";
            }
      }

}
