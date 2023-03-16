<?php

namespace app\controllers;

use app\components\Constant;
use app\models\Action;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Request;

class SiteController extends Controller
{
    public $authService = null;
    public $userService = null;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
        $this->authService = new \app\services\AuthService();
        $this->userService = new \app\services\UserService();
    }

    public function behaviors()
    {
        return Action::getAccess($this->id);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'main-error',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => 'testme',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionProfile(Request $request)
    {
        $user_component = Yii::$app->user;
        $model = $this->userService->findDataForUpdate($user_component->id);

        if ($request->getIsAjax()) {
            if ($this->userService->update($model, $request->post())) {
                return $this->asJson(['success' => true, 'message' => $this->authService->messageUpdateSuccess("Profile")]);
            } else {
                return $this->asJson(['success' => false, 'message' => $this->authService->messageUpdateFailed("Profile")]);
            }
        } else if ($request->getIsPost()) {
            if ($this->userService->update($model, $request->post())) {
                toastSuccess($this->service->messageUpdateSuccess("Profile"));
                return $this->redirect(Url::to(['site/profile']));
            } else {
                toastError($this->service->messageUpdateFailed("Profile"));
            }
        }

        return $this->render('profile', compact('model'));
    }

    public function actionLogin(Request $request)
    {
        $this->layout = "main-login";
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['site/index']);
        }

        $model = $this->authService->loginForm();
        if ($request->getIsAjax()) {
            if ($this->authService->login($model, $request->post())) {
                return $this->asJson(["success" => true, "message" => "Login success"]);
            } else {
                return $this->asJson(["success" => false, "message" => Constant::flattenError($model->getErrors())]);
            }
        } else if ($request->getIsPost()) {
            if ($this->authService->login($model, $request)) {
                return $this->redirect(['site/']);
            }
        }

        return $this->render('login', compact('model'));
    }

    public function actionLogout()
    {
        $this->authService->logout();
        return $this->redirect(['site/login']);
    }
}
