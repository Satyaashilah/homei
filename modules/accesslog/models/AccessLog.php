<?php

namespace app\modules\accesslog\models;

use Yii;
use \app\modules\accesslog\models\base\AccessLog as BaseAccessLog;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "access_log".
 * Modified by Defri Indra M
 */
class AccessLog extends BaseAccessLog
{
    public static function getTypes()
    {
        return [
            'web' => 'Web',
            'api' => 'API',
        ];
    }

    public function getType()
    {
        return static::getTypes()[$this->type];
    }

    /**
     * record access log
     */
    public static function record($type = "api", $response = null)
    {
        $log = new AccessLog();
        $log->ip = Yii::$app->request->userIP;
        $log->path = Yii::$app->request->pathInfo;
        $log->request = json_encode(Yii::$app->request->bodyParams);
        $log->method = Yii::$app->request->method;
        $log->response = ($type == "api") ? json_encode($response->data) : null;

        $user = \app\components\Constant::getUser();
        if ($user) {
            $log->user_id = $user->id;
            $log->username = $user->username;
            $log->role = $user->role->name;
        } else {
            $log->user_id = null;
            $log->username = null;
            $log->role = null;
        }

        if ($log->validate()) $log->save();
    }
}
