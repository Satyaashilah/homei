<?php

namespace app\services;

use app\services\base\Service;
use app\services\forms\auth\LoginForm;
use app\services\forms\auth\RegisterForm;
use Yii;
use yii\db\Expression;
use yii\web\Request;

/**
 * AuthService
 * @package app\services
 * @author Defri Indra Mahardika <defrindr@gmail.com>
 */
class AuthService extends Service
{
    use \app\traits\MessageTrait;
    public $model = 'app\models\User';

    /**
     * @return LoginForm
     */
    public function loginForm()
    {
        return new LoginForm();
    }

    /**
     * @return RegisterForm
     */
    public function registerForm()
    {
        return new RegisterForm();
    }

    /**
     * @return User Model
     */
    public function updateProfileForm()
    {
        return new $this->model;
    }

    /**
     * @param User $model User Model
     * @param Request $request Request
     * @return boolean true if success, false if fail
     */
    public function login($model, $request)
    {
        $model->load($request);
        if ($model->validate()) {
            if ($model->login()) {
                $user = $this->me();
                $user->last_login = new Expression('NOW()');
                $user->status = 1;
                $user->save();
                return true;
            }
        }

        return false;
    }

    /**
     * @return boolean true if success, false if fail
     */
    public function logout()
    {
        $user = $this->me();
        if ($user) {
            $user->last_logout = new Expression('NOW()');
            $user->status = 3;
            $user->save();
        }
        return Yii::$app->user->logout();
    }

    /**
     * @return User|NULL return user model if already logged on, null if no 
     */
    public function me()
    {
        $id_user = Yii::$app->user->id;
        return $this->model::find()->where(['id' => $id_user])->one();
    }

    /**
     * @param RegisterForm $model RegisterForm
     * @param Request $request Request
     * @return boolean true if success, false if fail
     */
    public function register(RegisterForm $model, Request $request)
    {
        $model->attributes = $request;
        if ($model->validate()) {
            return $model->register();
        }

        return false;
    }
}
