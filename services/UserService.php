<?php

namespace app\services;

use app\components\Constant;
use app\models\User;
use app\services\base\Service;
use yii\base\Security;

class UserService extends Service
{
    use \app\traits\UploadFileTrait;
    use \app\traits\MessageTrait;

    public $model = 'app\models\User';

    public function getUploadedFile()
    {
        $model = $this->getModel();
        return \yii\web\UploadedFile::getInstance($model, 'photo_url');
    }

    public function getModel()
    {
        return new $this->model;
    }

    public function getDataProvider($request)
    {
        $searchModel = new \app\models\search\UserSearch();
        $dataProvider = $searchModel->search($request);
        return compact('searchModel', 'dataProvider');
    }

    public function getAll()
    {
        return $this->model::find()->active()->all();
    }

    public function findById(String $id)
    {
        return $this->model::find()->where(["id" => $id])->active()->one();
    }

    public function findDataForUpdate(String $id)
    {
        $user = $this->findById($id);
        if (!$user) {
            return null;
        }
        $user->password = '';
        return $user;
    }

    public function create(User $user, $request)
    {
        $instance = $this->getUploadedFile();
        $photo_url = "default.png";


        if ($instance) {
            $response = $this->uploadImage($instance, 'user_image');
            if ($response->success) {
                $photo_url = $response->fileName;
            } else {
                $photo_url = "default.png";
            }
        } else {
            $photo_url = "default.png";
        }

        $security = new Security();
        $user->load($request);
        $user->photo_url = $photo_url;

        if (!$user->validate()) {
            $user->password = '';
            toastError(Constant::flattenError($user->errors));
            return false;
        }

        $user->password = $security->generatePasswordHash($user->password);

        $user->save();

        return $user;
    }

    public function update(User $user, $request)
    {
        $user->scenario = User::SCENARIO_UPDATE;
        $photo_url = $user->oldAttributes['photo_url'];

        $instance = $this->getUploadedFile();
        if ($instance) {
            $response = $this->uploadImage($instance, 'user_image');

            if (!$response->success) {
                return false;
            }

            $photo_url = $response->fileName;
            $this->deleteFile($user->oldAttributes['photo_url']);
        }

        $user->load($request);
        $user->photo_url = $photo_url;

        if ($user->password) {
            $security = new Security();
            $user->password = $security->generatePasswordHash($user->password);
        } else {
            $user->password = $user->oldAttributes['password'];
        }

        if (!$user->validate()) {
            $user->password = '';
            return false;
        }

        $user->save();

        return $user;
    }

    /**
     * Delete User and return photo_url if success
     * @param String $id
     */
    public function delete(String $id)
    {
        $me = \Yii::$app->user->identity;

        if ($me->role_id !== Constant::ROLE_SA) {
            toastError('You are not allowed to delete this user');
            return false;
        }

        if ($id === $me->id) {
            toastError('You can not delete yourself');
            return false;
        }

        $user = $this->findById($id);
        $photo_url = $user->photo_url;

        if (!$user->delete()) {
            toastError('Failed to delete user');
            return false;
        }

        $this->deleteFile($photo_url);
        return true;
    }
}
