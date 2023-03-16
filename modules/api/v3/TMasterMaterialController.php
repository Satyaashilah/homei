<?php
namespace app\controllers\api;
use yii\rest\Controller;
use Yii;
use app\models\TMasterMaterial;

class TMasterMaterialController extends Controller
{
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
    public $modelClass = "\app\models\TMasterMaterial";

    public function actionIndex() {
        return [
            "success" => true,
        ];
    }

    public function actionView($id) {
        $data = TMasterMaterial::find();
        $id = \Yii::$app->request->get('id');
        $field = \Yii::$app->request->get('field');
        
        if($id) {
            $data = $data->andWhere(['like','id',$id])->limit(1);
        } else {
            return [
                "success" => false,
                "message" => "Parameter :id must be set"
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
        }
        $result = $data->all();

        if(count($result) == 0) {
            return [
                "success" => false,
                "message" => "Data not found : name -> $name"
            ];
        }
        return [
            "data"=>$result
        ];
    }

    public function actionPost() {

      \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
      $data = new TMasterMaterial();
      $data->scenario = TMasterMaterial::SCENARIO_CREATE;
      $data->attributes = \yii::$app->request->post();
      if($data->validate())
      {
       $data->save();
       return array('status' => true, 'data'=> 'Data record is successfully updated');
      }
      else
      {
       return array('status'=>false,'data'=>$data->getErrors());    
      }
    }

    public function actionList()
    {
        $data = \app\models\TMasterMaterial::find();
        $id = \Yii::$app->request->get('id');
        $field = \Yii::$app->request->get('field');


        if($id) {
            $data = $data->andWhere(['like','id',$id]);
        } else {
            return [
                "success" => false,
                "message" => "Parameter : id must be set"
            ];
        }


        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = ['' ];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }else {
            $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="t_master_material" and COLUMN_NAME not in ("flag", "as")')->queryAll();
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
     $data = TMasterMaterial::find()->where(['id' => $attributes['id'] ])->One();
    //  var_dump($data);die;
      if($data)
      {
       $data->attributes = \yii::$app->request->post();
       $data->save();
       return array('status' => true, 'data'=> 'Data Master Material record is updated successfully');
      
      }
    else
    {
       return array('status'=>false,'data'=> 'No Data Master Material Found');
    }
    }

    
    public function actionDeleted($id){
        $data=\app\models\TMasterMaterial::find()->where(['id'=>$id])->one();
        $harga = \app\models\THargaMaterial::deleteAll(['id_material' => $id]);
        if($data->delete()){
            return "Berhasil";
        }
    }
}
