<?php

namespace app\modules\api\controllers;

use Throwable;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\web\HttpException;
use yii\web\Response;

/**
 * This is the class for REST controller "PlaceController".
 */

class BaseController extends \yii\rest\Controller
{
    use \app\traits\MessageTrait;

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'data',
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return array_merge([
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ],
            'authentication' => [
                'class' => \app\components\CustomAuth::class,
                'except' => [],
                'only' => [],
            ]
        ], $behaviors);
    }

    /**
     * @inheritdoc
     */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        return $this->serializeData($result);
    }

    /**
     * Declares the allowed HTTP verbs.
     * Please refer to [[VerbFilter::actions]] on how to declare the allowed verbs.
     * @return array the allowed HTTP verbs.
     */
    protected function verbs()
    {
        return [];
    }

    /**
     * Serializes the specified data.
     * The default implementation will create a serializer based on the configuration given by [[serializer]].
     * It then uses the serializer to serialize the given data.
     * @param mixed $data the data to be serialized
     * @return mixed the serialized data.
     */
    protected function serializeData($data)
    {
        return \Yii::createObject($this->serializer)->serialize($data);
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        $parent = parent::actions();

        unset($parent['index']);
        unset($parent['view']);
        unset($parent['create']);
        unset($parent['update']);
        unset($parent['delete']);

        return $parent;
    }

    public function dataProvider($query, $perpage = null, $withPagination = true)
    {
        $setting = [
            'query' => $query,
            'pagination' => [
                'pageSize' => ($perpage) ? $perpage : 20,
            ],
        ];

        if ($withPagination == false) {
            return $query->all();
        }
        return new ActiveDataProvider($setting);
    }

    public function findModel($query, $customClass = null)
    {
        try {
            if ($customClass) {
                $model = $customClass::findOne($query);
            } else {
                $model = $this->modelClass::findOne($query);
            }
        } catch (Throwable $th) {
            throw new HttpException(400);
        }

        if ($model == null) {
            throw new HttpException(404);
        }

        return $model;
    }
}
