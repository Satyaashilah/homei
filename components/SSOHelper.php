<?php

namespace app\components;

use app\models\User;
use Yii;

class SSOHelper
{
    const IDENTITY_CLASS = "\app\models\User";
    const IDENTITY_VAR = "id";

    /**
     * Syncronize user identity with SSO token
     */
    const INTEGRATION_VARS = [
        "fcm_token" => "fcm_token",
    ];

    public static function getUserData($fields, $token)
    {
        $url = "http://localhost/kuota-batu/web/api/v1/user/this-is-really-really-secret-method-to-get-data-for-registration-another-module";
        $response = \app\helpers\HttpHelper::post($url, [
            "fields" => $fields,
        ], [
            "Authorization" => $token,
        ]);

        return $response;
    }

    public static function checkToken()
    {

        $token = Yii::$app->request->headers->get('Authorization');
        $token = str_replace("Bearer ", "", $token);
        if ($token) :
            $response = SSOHelper::getUserData(["username"], $token);
            if ($response->success) :
                $data = (array) $response->data;
                if (isset($data['username'])) :
                    $user = User::findOne(['username' => $data['username']]);
                    if ($user) :
                        Yii::$app->user->login($user);
                        return $user;
                    endif;
                endif;
            endif;
        endif;

        return null;
    }
}
