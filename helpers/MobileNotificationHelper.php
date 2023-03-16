<?php

namespace app\helpers;

use Yii;

class MobileNotificationHelper
{
    public static function fcm($token, $data, $callback = null)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $msg = [
            'body' => $data["body"],
            'title' => $data["title"],
            'image' => $data["image"],
            'vibrate' => 1,
            'sound' => "default",
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon',
        ];

        if (isset($token)) {
            if (gettype($token) == "array") $registration_ids = $token;
            else $registration_ids = [$token];
        } else $registration_ids = [];

        if ($registration_ids != []) {
            if ($callback !== null) $data = $callback($data);

            $fields = [
                'registration_ids' => $registration_ids,
                'priority' => "high",
                'notification' => $msg,
                'data' => $data,
            ];

            $headers = [
                'Authorization' => 'key = ' . Yii::$app->params['app']['fcm_key'],
                'Content-Type' => 'application/json',
            ];

            $response = HttpHelper::postApi($url, $fields, $headers);
            return $response;
        }
    }


    /**
     * Action to send expo notification
     * @param $token
     * @param $data
     * @param $callback
     * @return mixed
     * 
     */
    public static function expo($token, $data, $callback = null)
    {
        $url = 'https://exp.host/--/api/v2/push/send';

        $data = [
            'to' => [],
            'body' => $data["body"],
            'title' => $data["title"],
            'data' => $data,
            'priority' => "high",
        ];

        /**
         * if token limit is more than 100, then split it
         * and send it to expo
         * https://forums.expo.dev/t/push-notification-to-50-thousand-device/20065/2
         */
        $list_token = [];
        $count = count($token);

        $counter = 0;
        $length_array = 0;
        for ($i = 0; $i < $count; $i++) {
            $list_token[$length_array][$counter] = $token[$i];
            if ($counter == 99) {
                $length_array += 1;
                $counter = 0;
            } else {
                $counter++;
            }
        }

        for ($i = 0; $i <= $length_array; $i++) {
            $data['to'] = $list_token[$i];
            $response = HttpHelper::postApi($url, json_encode($data), [
                "content-type" => "Application/json",
            ]);
        }

        return $response;
    }
}
