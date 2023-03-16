<?php

namespace app\modules\blog\controllers;

use Yii;

class MediaController extends \yii\web\Controller
{
    private $basePath = "";
    private $baseUrl = "";

    // override constructor
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->basePath = \Yii::getAlias('@webroot/uploads/blog/media');
        $this->baseUrl = \Yii::getAlias('@file/blog/media');
        if ($this->basePath) {
            if (!file_exists($this->basePath)) {
                mkdir($this->basePath, 0777, true);
            }
        }
    }

    public function actions()
    {
        // disable schema
        Yii::$app->params['without_schema'] = true;

        return [
            // register images-get action
            'images-get' => [
                'class' => 'vova07\imperavi\actions\GetImagesAction',
                'url' => $this->baseUrl, // Directory URL address, where files are stored.
                'path' => $this->basePath, // Or absolute path to directory where files are stored.
                'options' => [
                    'only' => [
                        '*.jpg', '*.jpeg', '*.png', '*.gif', '*.ico'
                    ]
                ], // These options are by default.
            ],
            // register image-upload action
            'image-upload' => [
                'class' => 'vova07\imperavi\actions\UploadFileAction',
                'url' => $this->baseUrl, // Directory URL address, where files are stored.
                'path' => $this->basePath, // Or absolute path to directory where files are stored.
            ],
        ];
    }
}
