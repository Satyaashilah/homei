<?php

namespace app\modules\api\modules\v1\controllers;

/**
 * This is the class for REST controller "MasterMaterialController".
 * Modified by Defri Indra
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Yii;
use yii\rest\Controller;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\User;
use app\models\Role;
use yii\web\Response;

class AuthController extends \app\modules\api\controllers\BaseController
{
    use \app\traits\MessageTrait;
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

    public function actionIndex(){
        $query = $this->modelClass::find();
        return $this->dataProvider($query);
    }

    public function actionLogin()
    {
        $this->layout = '../layouts/frontend';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $session = Yii::$app->session;
        $model = new LoginForm();
        if (!isset($session['user']['login'])) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                // return $this->goBack();
                $userdata = User::find()->where(['id' => Yii::$app->user->getId()])->asArray()->all();

                $session['user'] = array(
                    "login" => true,
                    "id" => $userdata[0]['id'],
                    "username" => $userdata[0]['username'],
                    "name" => $userdata[0]['name'],
                );

                // cek role
                // var_dump($userdata[0]['role_id']);
                // die;
                if ($userdata[0]['role_id'] == 1) {
                    return $this->redirect(["site/index"]);
                } else {
                    return $this->redirect(["user/index"]);
                }
            } else {
                $model->password = '';

                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public static function flattenError($errors)
    {
        $flatten = [];

        foreach ($errors as $errorAttr) :
            foreach ($errorAttr as $error) :
                $flatten[] = "$error";
            endforeach;
        endforeach;

        if ($flatten == []) {
            return null;
        }

        return $flatten[0];
    }

    public function actionRegister()
    {
        $this->layout = "../layouts/main-login";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->register()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        $headers = Yii::$app->request->headers;
        $accept = $headers->get('Authorization');
        $model = User::find()->where(['secret_token'=>$accept])->one();
        if(!empty($model))
        {
            \Yii::$app->user->logout(false);
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'success' => true,
                'message' => 'Berhasil Logout',
    
            ];
        }else {
            return [
                "success" => false,
                "message" => "Gagal Logout"
            ];
        }
    }
}
