<?php

/**
 * @author    Defri Indra Mahardika <defrindr@gmail.com>
 * @link      https://github.com/defrindr
 * @copyright Copyright (c) 2022
 */

return [
    'class' => 'yii\web\UrlManager',
    'showScriptName' => false,
    'enablePrettyUrl' => true,
    'rules' => [
        // api route
        // '<module>/api/v1/<controller:[\w\-\_]+>/<action:[\w\-\_]+>/<id:[\w\-\_]+>' => '<module>/api/v1/<controller>/<action>',
        // '<module>/api/v1/<controller:[\w\-\_]+>/<action:[\w\-\_]+>' => '<module>/api/v1/<controller>/<action>',
        // 'api/v1/<controller:[\w\-\_]+>/<action:[\w\-\_]+>/<id:[\w\-\_]+>' => 'api/v1/<controller>/<action>',
        // 'api/v1/<controller:[\w\-\_]+>/<action:[\w\-\_]+>' => 'api/v1/<controller>/<action>',

        /**
         * Dangerous Route
         * dont change this route
         * without knowing what you are doing
         */

        // web route
        // '<controller:[\w\-\_]+>' => '<controller>/index',
        // '<controller:[\w\-\_]+>/<action:[\w\-\_]+>' => '<controller>/<action>',

        // '<module>/<controller:[\w\-\_]+>' => '<module>/<controller>/index',
        // '<module>/<controller:[\w\-\_]+>/<action:[\w\-\_]+>' => '<module>/<controller>/<action>',

        // '<controller:[\w\-\_]+>/<action:[\w\-\_]+>/<id:[\w\-\_]+>' => '<controller>/<action>',
        // '<module>/<controller:[\w\-\_]+>/<action:[\w\-\_]+>/<id:[\w\-\_]+>' => '<module>/<controller>/<action>',
    ],
];
