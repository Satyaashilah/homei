<?php

namespace app\modules\blog\controllers\api\v1;

/**
 * This is the class for REST controller "KategoriController".
 * Modified by Defri Indra
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Yii;

class KategoriController extends \app\modules\api\controllers\BaseController
{
    use \app\traits\MessageTrait;
    public $modelClass = 'app\modules\blog\models\Kategori';
    public $validation = null;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['authentication'] = [
            "class" => "\app\components\CustomAuth",
            "except" => ["index", "view"]
        ];

        return $parent;
    }

    public function verbs()
    {
        return [
            'index' => ['GET'],
            'view' => ['GET'],
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
        ];
    }

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        // $this->validation = new \app\validations\Validation();
    }

    public function actionIndex()
    {
        $query = $this->modelClass::find();
        return $this->dataProvider($query);
    }

    /**
     * get popular post from specific category
     * @param $id
     * @return array
     */
    public function actionView($id)
    {
        $query = $this->modelClass::find()
            ->joinWith('postKategoris')
            ->joinWith('postKategoris.post')
            ->where(['blog_post.flag' => 1])
            ->andWhere(['blog_post_kategori.id_kategori' => $id])
            ->orderBy('blog_post.view DESC')
            ->limit(5);
        return $this->dataProvider($query);
    }
}
