<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * RegisterForm is the model behind the register form.
 *
 * @property-read User|null $user
 *
 */
class RegisterForm extends Model
{
    public $username;
    public $password;
    public $name;
    public $no_hp;
    public $email;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'name', 'no_hp', 'email'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            // ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function register()
    {
        if ($this->validate()) {
            $model = new User;
            $model->username = $this->username;
            $model->password = Yii::$app->security->generatePasswordHash($this->password);
            $model->name = $this->name;
            $model->no_hp = $this->no_hp;
            $model->email = $this->email;
            // $model->auth_key = null;
            $model->role_id = 3;
            if($model->validate()) {
                $model->save();
                return Yii::$app->user->login($model, $this->rememberMe ? 3600*24*30 : 0);
            }
            $this->addErrors($model->getErrors());
        }
        return false;
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
           $this->password_hash=$this->setPassword($this->password_hash);
           return true;
        }else{
           return false;
        }
    }

    public function actionChangePassword($password)
    {
        print \Yii::$app->security->generatePasswordHash($password)."\n";
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
