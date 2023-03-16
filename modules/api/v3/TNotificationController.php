<?php
namespace app\controllers\api;
use yii\rest\Controller;


class TNotificationController extends Controller
{
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

    public function filters()
    {
        $data = \app\models\TNotification::find();
        $name = \Yii::$app->request->get('name');
        $field = \Yii::$app->request->get('field');
        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = ['controller'];
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
        
        // if($result == null) {
        //     return [
        //         "success" => false,
        //         "message" => "Data not found : name -> $name"
        //     ];
        // }
        return [
            "data"=>$result
        ];
            return array();
    }

    // Actions 

    public function actionIndex() {
        return [
            "success" => true,
        ];
    }

    public function actionView() {
        $data = \app\models\TNotification::find();
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
                $excludes = ['read'];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }else {
            $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="t-notification" and COLUMN_NAME not in ("password","secret_token")')->queryAll();
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

    public function actionList()
    {
        $data = \app\models\Users::find();
        $name = \Yii::$app->request->get('user_id');
        $field = \Yii::$app->request->get('field');


        if($user_id) {
            $data = $data->andWhere(['like','name',$user_id]);
        } else {
            return [
                "success" => false,
                "message" => "Parameter :user id must be set"
            ];
        }


        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = ['read' ];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }else {
            $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="t_notification" and COLUMN_NAME not in ("read")')->queryAll();
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
                "message" => "Data not found : user_id -> $user_id"
            ];
        }
        return [
            "data"=>$result
        ];
    }

    public function actionUpdated(){

     Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON; 
     $attributes = \yii::$app->request->post();
     $data = Users::find()->where(['USER_ID' => $attributes['user_id'] ])->one();
    //  var_dump($data);die;
      if($data)
      {
       $data->attributes = \yii::$app->request->post();
       $data->save();
       return array('status' => true, 'data'=> 'Data notification record is updated successfully');
      
      }
    else
    {
       return array('status'=>false,'data'=> 'No Data notification Found');
    }
    }



    public function actionPost() {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $data = new Notification();
        $data->scenario = Notification::SCENARIO_CREATE;
        $data->attributes = \yii::$app->request->post();
        if($data->validate())
        {
          var_dump($data->save());die;
         return array('status' => true, 'data'=> 'Data record is successfully created');
        }
        else
        {
         return array('status'=>false,'data'=>$data->getErrors());    
        }
      }



    public function actionDeleted($id){
      $data= \app\models\TNotification::find()->where(['id'=>$id])->one();
    //   $data = \app\models\Users::deleteAll(['role_id' => $id]);
        if($data->delete()){
          return "Berhasil";
      }
    }

}
