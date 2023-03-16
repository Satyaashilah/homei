<?php

namespace app\helpers;

use Yii;
use yii\base\Event;

/**
 * ErrorResponseHelper
 * 
 * @author Defri Indra M <
 */
class ErrorResponseHelper
{
    const allowed_keys = ["success", "data", "message", "code", "token"];

    public static function beforeResponseSend(Event $event)
    {
        $response = $event->sender;
        $request = Yii::$app->request;

        if (Yii::$app->params['without_schema'] == true) :
            return $event;
        endif;

        $url = str_replace($request->getBaseUrl(), "", $request->getUrl());

        $content_type = strtolower(Yii::$app->request->headers->get("content-type"));

        if ($response->format == "json" || $content_type == "application/json" || is_int(strpos($url, "/api/"))) :
            $response->format = "json";

            $logged = (new \app\helpers\SsoTokenHelper)->checkToken();
            if ($logged['success']) {
                // logging
                if (class_exists('\app\modules\accesslog\models\AccessLog')) {
                    \app\modules\accesslog\models\AccessLog::record("api", $response);
                }
            }

            if ($response->statusCode != 200 && $response->statusText != "OK") :
                if (is_array($response->data)) :
                    if ($response->data['message']) :
                        $message = $response->data['message'];
                    else :
                        $message = $response->statusText;
                    endif;
                else :
                    $message = $response->statusText;
                endif;

                $response->data = [
                    'success' => false,
                    "message" => $message,
                    'code' => $response->statusCode,
                ];
            else :
                if (is_array($response->data)) :
                    self::handleResponseArray($response);
                else :
                    self::handleResponseObject($response);
                endif;
            endif;
        elseif ($response->format == "html") :
            if (class_exists('\app\modules\accesslog\models\AccessLog')) {
                $excepts = ["accesslog", "debug", "http://"];
                $allowed_log = true;
                foreach ($excepts as $except) {
                    if (substr(Yii::$app->request->pathInfo, 0, strlen($except)) == $except) {
                        $allowed_log = false;
                        break;
                    }
                }

                if ($allowed_log) {
                    \app\modules\accesslog\models\AccessLog::record("web");
                }
            }
        endif;

        return $event;
    }

    /**
     * handle array
     * @param Object $response
     */
    private static function handleResponseArray(&$response)
    {
        if (!isset($response->data['success']) && !(isset($response->data['code']) || isset($response->data['status']))) :
            $message = self::getMessage($response);

            if (isset($response->data['data']) && isset($response->data['_meta'])) {
                $response->data = array_merge([
                    'success' => true,
                    "message" => $message,
                    "data" => [],
                    'code' => 200,
                ], $response->data);
            } else {
                $response->data = [
                    'success' => true,
                    "message" => $message,
                    "data" => $response->data,
                    'code' => 200,
                ];
            }
        elseif ($response->data['code'] == null || $response->data['status'] == null || $response->data['code'] == 0) :
            self::removeKeys($response, 'array');
            $message = self::getMessage($response);

            $response->data["success"] = $response->data["success"] ?? true;
            $response->data["message"] = $message;
            $response->data['data'] = $response->data['data'] ?? [];
            $response->data["code"] = 200;
        endif;
    }

    /**
     * handle object
     * @param Object $response
     */
    private static function handleResponseObject(&$response)
    {
        $res = $response->data;
        if (!isset($res->success) && !(isset($res->code) || isset($res->status))) :
            $code = $res->code ?? $res->status;
            $message = self::getMessage($response, 'object');

            $response->data = [
                'success' => true,
                "message" => $message,
                "data" => $response->data,
                'code' => $code ?? 200,
            ];
        elseif ($res->code == null || $res->status == null || $res->code == 0) :
            self::removeKeys($response, 'object');
            $message = self::getMessage($response, 'object');

            $res->success = $res->success ?? true;
            $res->message = $message;
            $res->data = $res->data ?? [];
            $res->code = 200;
        endif;
    }

    /**
     * Gettig message
     * @param \yii\web\Response $response
     * @param string $type
     *
     * @return string
     */
    private static function getMessage($response, $type = "array")
    {
        $message = $response->statusText;
        if (strtolower($type) == 'array') :
            if (isset($response->data['message'])) :
                $message = $response->data['message'];
                unset($response->data['message']);
            endif;
        else :
            $res = $response->data;
            if (isset($res->message)) :
                $message = $res->message;
                unset($res->message);
            endif;
        endif;

        return $message;
    }

    protected static function removeKeys(&$response, $key = "object")
    {
        if (strtolower($key) == "object") :
            $keys = array_keys((array) $response->data);
            foreach ($keys as $key) :
                if (in_array($key, static::allowed_keys) == false) :
                    unset($response->data->$key);
                endif;
            endforeach;
        else :
            $keys = array_keys($response->data);
            foreach ($keys as $key) :
                if (in_array($key, static::allowed_keys) == false) :
                    unset($response->data[$key]);
                endif;
            endforeach;
        endif;
    }
}
