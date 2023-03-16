<?php

namespace app\models;

use Yii;

class User extends \app\models\base\User implements \yii\web\IdentityInterface
{

    const SCENARIO_UPDATE = "app-user-update";
    const SCENARIO_REGISTER_APP = "app-user-appregister";
    const ROLE_USER_REGULER = 3;
    const ROLE_SUPER_ADMIN = 1;

    public $_render = [];

    /**
     * @inheiritance
     */
    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['username'], 'match', 'pattern' => '/^[A-Za-z0-9_\-]+$/u']; // only allowed alphanumeric characters, dashes and underscores
        return $rules;
    }

    /**
     * @inheiritance
     */
    public function scenarios()
    {
        $parent = parent::scenarios();
        $columns = ["username", "password", "phone", "email", "name", "photo_url"];

        $parent[static::SCENARIO_REGISTER_APP] = $columns;
        $parent[static::SCENARIO_UPDATE] = $columns;
        return $parent;
    }

    /**
     * @inheiritance
     */
    public function fields()
    {
        $parent = parent::fields();

        if (isset($parent['id'])) :
            unset($parent['id']);
            $parent['id'] = function ($model) {
                return $model->id;
            };
        endif;
        if (isset($parent['username'])) :
            unset($parent['username']);
            $parent['username'] = function ($model) {
                return $model->username;
            };
        endif;
        if (isset($parent['password'])) :
            unset($parent['password']);
        endif;
        if (isset($parent['name'])) :
            unset($parent['name']);
            $parent['name'] = function ($model) {
                return $model->name;
            };
        endif;
        if (isset($parent['email'])) :
            unset($parent['email']);
            $parent['email'] = function ($model) {
                return $model->email;
            };
        endif;
        if (isset($parent['phone'])) :
            unset($parent['phone']);
            $parent['phone'] = function ($model) {
                return $model->phone;
            };
        endif;
        if (isset($parent['role_id'])) :
            unset($parent['role_id']);
            $parent['role_id'] = function ($model) {
                return $model->role_id;
            };
            $parent['_role'] = function ($model) {
                $rel = $model->getRole()->select('name')->one();
                if ($rel) :
                    return $rel;
                endif;
                return null;
            };
        endif;
        if (isset($parent['secret_token'])) :
            unset($parent['secret_token']);
        endif;
        if (isset($parent['fcm_token'])) :
            unset($parent['fcm_token']);
            $parent['fcm_token'] = function ($model) {
                return $model->fcm_token;
            };
        endif;
        if (isset($parent['photo_url'])) :
            unset($parent['photo_url']);
            $parent['photo_url'] = function ($model) {
                return Yii::$app->formatter->asFileLink($model->photo_url);
            };
        endif;
        if (isset($parent['last_login'])) :
            unset($parent['last_login']);
            $parent['last_login'] = function ($model) {
                return Yii::$app->formatter->asIddate($model->last_login, false);
            };
        endif;
        if (isset($parent['last_logout'])) :
            unset($parent['last_logout']);
            $parent['last_logout'] = function ($model) {
                return Yii::$app->formatter->asIddate($model->last_logout, false);
            };
        endif;
        if (isset($parent['registered_at'])) :
            unset($parent['registered_at']);
            $parent['registered_at'] = function ($model) {
                return Yii::$app->formatter->asIddate($model->registered_at, false);
            };
        endif;
        if (isset($parent['flag'])) :
            unset($parent['flag']);
        endif;



        return $parent;
    }


    public function getIsSuperAdmin()
    {
        return $this->role_id == self::ROLE_SUPER_ADMIN;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return User::find()->where(["id" => $id])->active()->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return User::find()->where(["username" => $username])->active()->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    public function getRoleName()
    {
        if ($role = $this->role) {
            return $role->name;
        }

        return "-";
    }
}
