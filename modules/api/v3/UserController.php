<?php
namespace app\controllers\api;
use yii\rest\Controller;
use Yii;
use app\models\Users;
use app\models\Role;
/**
 * UsersController implements the CRUD actions for Users model.
 */
class UserController extends Controller
{
    public $modelClass = "\app\models\Users";
    /**
     * @inheritdoc
     */
    public function behaviors() {
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

    public function actionList()
    {
        $data = \app\models\Users::find();
        $name = \Yii::$app->request->get('name');
        $field = \Yii::$app->request->get('field');


        if($name) {
            $data = $data->andWhere(['like','name',$name]);
        } else {
            return [
                "success" => false,
                "message" => "Parameter :name must be set"
            ];
        }


        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = ['password', 'secret_token' ];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }else {
            $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="user" and COLUMN_NAME not in ("password","secret_token")')->queryAll();
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
        return [
            "data"=>$result
        ];
    }

    public function actionView() {
        $data = \app\models\Users::find();
        $name = \Yii::$app->request->get('name');
        $field = \Yii::$app->request->get('field');
        if($name) {
            $data = $data->andWhere(['like','name',$name])->limit(1);
        } else {
            return [
                "success" => false,
                "message" => "Parameter :name must be set"
            ];
        }
        

        if ($field){
            $allowed_field = array_filter($field, function($item) {
                $excludes = ['password', 'secret_token' ];
                if(in_array($item, $excludes)) {
                    return false;
                } 
                return true;
            });
            $data=$data->select($allowed_field);
        }else {
            $data_columns = \Yii::$app->db->createCommand('SELECT COLUMN_NAME FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`="db_homei" and `TABLE_NAME`="user" and COLUMN_NAME not in ("password","secret_token")')->queryAll();
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
        return [
            "data"=>$result
        ];
    }

    public function actionUpdated(){

     Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON; 
     $attributes = \yii::$app->request->post();
     $data = Users::find()->where(['id' => $attributes['id'] ])->one();
    //  var_dump($data);die;
      if($data)
      {
       $data->attributes = \yii::$app->request->post();
       $data->save();
       return array('status' => true, 'data'=> 'Data User record is updated successfully');
      
      }
    else
    {
       return array('status'=>false,'data'=> 'No Data User Found');
    }
    }



    public function actionPost() {

        \Yii::$app->response->format = \yii\web\Response:: FORMAT_JSON;
        $data = new Users();
        $data->scenario = Users::SCENARIO_CREATE;
        $data->attributes = \yii::$app->request->post();
        if($data->validate())
        {
            $data->password = Yii::$app->security->generatePasswordHash($data->attributes['password']);
            $data->save();
        //   var_dump($data->save());die;
         return array('status' => true, 'data'=> 'Data record is successfully created');
        }
        else
        {
         return array('status'=>false,'data'=>$data->getErrors());    
        }
      }



    public function actionDeleted($username){
      $data= \app\models\Users::find()->where(['username'=>$username])->one();
    //   $data = \app\models\Users::deleteAll(['role_id' => $id]);
        if($data->delete()){
          return "Berhasil";
      }
    }
}
