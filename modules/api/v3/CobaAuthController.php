<?php

namespace app\controllers\api;

use yii\rest\Controller;
use Yii;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\User;
use app\models\Role;
use yii\web\Response;

/**
 * AuthController implements the CRUD actions for LoginForm model.
 */
class AuthController extends Controller
{
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
    // public function actionLogin()
    // {
    //     $model = new LoginForm();
    //     if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
    //         $model->validate();

    //         return [
    //             'success' => true,
    //             'message' => 'Berhasil Login',

    //         ];
    //     }
    //     Yii::$app->response->format = Response::FORMAT_JSON;

    //     return [
    //         'success' => false,
    //         'message' => 'Gagal Login'
    //     ];
    // }

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
    // public function actionRegister()
    // {
    //     $model = new RegisterForm();
    //     $model->username = Yii::$app->request->post('username');
    //     $model->password = Yii::$app->getSecurity()->generatePasswordHash('password');
    //     $model->name = Yii::$app->request->post('name');
    //     $model->no_hp = Yii::$app->request->post('no_hp');
    //     $model->email = Yii::$app->request->post('email');

    //     if ($model->register()) {
    //         // $model->save();
    //         return [
    //             'success' => true,
    //             'message' => 'Berhasil Register',

    //         ];
    //     } else {
    //         return [
    //             'success' => false,
    //             'message' => self::flattenError($model->getErrors())
    //         ];
    //     }
    //     Yii::$app->response->format = Response::FORMAT_JSON;
    //     return [
    //         'success' => false,
    //         'message' => 'Gagal Register',

    //     ];
    // }
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
    
    // public function actionLogout()
    // {
    //     $headers = Yii::$app->request->headers;
    //     $accept = $headers->get('Authorization');
    //     $model = User::find()->where(['secret_token'=>$accept])->one();
    //     if(!empty($model))
    //     {
    //         \Yii::$app->user->logout(false);
    //         Yii::$app->response->format = Response::FORMAT_JSON;
    //         return [
    //             'success' => true,
    //             'message' => 'Berhasil Logout',
    
    //         ];

    //     }
    // }
}
