<?php

if (isset($response) == false) {
    $con = require_once(__DIR__ . '/db.php');
    unset($con['class']);
    $connection = new \yii\db\Connection($con);
    $connection->open();
    $query = $connection->createCommand("select *, web_config_group.name as group_name, web_config.name as name from web_config left join web_config_group on web_config.group_id = web_config_group.id");
    $data = $query->queryAll();

    $response = [];
    foreach ($data as $item) {
        if ($item['group_name']) {
            $response[$item['group_name']][$item['name']] = $item['active'] ? $item['value'] : $item['default'];
        } else {
            $response[$item['name']] = $item['active'] ? $item['value'] : $item['default'];
        }
    }
}

return $response;
