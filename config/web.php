<?php

require_once 'Custom.php';

$params = require __DIR__ . '/params.php';

// dd($params);

$config = [
    'id' => 'basic',
    'name' => 'BASE APP',
    "language" => "id-ID",
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Jakarta',
    'modules' => require __DIR__ . "/web/modules.php",
    'components' => [
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV3' => isset($params['app']['recaptchaClientKey']) ? $params['app']['recaptchaClientKey'] : '',
            'secretV3' => isset($params['app']['recaptchaServerKey']) ? $params['app']['recaptchaServerKey'] : '',
        ],
        'request' => array_merge([
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '4lw4ysS3cr37',
            'parsers' => [
                'multipart/form-data' => 'yii\web\MultipartFormDataParser',
                'application/json' => 'yii\web\JsonParser', // enable json parser
            ],
        ], (isset($params['baseUrl']) && $params['baseUrl'] != "")
            ? ['baseUrl' =>  $params['baseUrl']] // change project name
            : []),
        'response' => [
            'class' => '\yii\web\Response',
            'on beforeSend' => [
                \app\helpers\ErrorResponseHelper::class,
                "beforeResponseSend",
            ],
        ],
        'formatter' => [
            'class' => \app\components\formatter\CustomFormatter::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages', // if advanced application, set @frontend/messages
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        //'main' => 'main.php',
                    ],
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $params['adminEmail']['host'],
                'username' => $params['adminEmail']['email'],
                'password' => $params['adminEmail']['password'],
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager' => require __DIR__ . '/web/urlManager.php',

        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],

            ],
        ],
        'db' => require __DIR__ . '/db.php',
    ],
    'params' => $params,
    'defaultRoute' => isset($params['app']['defaultRoute']) ? $params['app']['defaultRoute'] : "site",
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => require __DIR__ . '/web/gii_generator.php',
    ];
}

return $config;
