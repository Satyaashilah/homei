<?php
/**
 * Customizable controller class.
 * Modified by Defri Indra
 */
echo "<?php\n";
?>

namespace <?=$generator->controllerNs?>\api\v1;

/**
 * This is the class for REST controller "<?=$controllerClassName?>".
 * Modified by Defri Indra
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use Yii;

class <?=$controllerClassName?> extends \app\modules\api\controllers\BaseController
{
    use \app\traits\MessageTrait;
    public $modelClass = '<?=$generator->modelClass?>';
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
        // $this->validation = new \app\validations\<?=$modelClass?>Validation();
    }

    public function actionIndex(){
        $query = $this->modelClass::find();
        return $this->dataProvider($query);
    }

    public function actionCreate(){
        $model = new $this->modelClass;
        $model->scenario = $model::SCENARIO_CREATE;

        try {
            if ($model->load(\Yii::$app->request->post(), '')) {
                if ($model->validate()) {
                    $model->save();

                    return [
                        "success" => true,
                        "message" => $this->messageCreateSuccess(),
                    ];
                }

                throw new \yii\web\HttpException(422, $this->message422(\app\components\Constant::flattenError($model->getErrors())));
            }
            throw new \yii\web\HttpException(400, $this->message400());
        } catch (\Throwable $th) {
            if(YII_DEBUG) throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
            else  throw new \yii\web\HttpException($th->statusCode ?? 500, $this->message500());
        }
    }

    public function actionUpdate($id){
        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_UPDATE;

        try {
            if ($model->load(\Yii::$app->request->post(), '')) {
                if ($model->validate()) {
                    $model->save();

                    return [
                        "success" => true,
                        "message" => $this->messageUpdateSuccess(),
                    ];
                }

                throw new \yii\web\HttpException(422, $this->message422(
                    \app\components\Constant::flattenError(
                        $model->getErrors()
                        )
                    )
                );
            }
            throw new \yii\web\HttpException(400, $this->message400());
        } catch (\Throwable $th) {
            if(YII_DEBUG) throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
            else  throw new \yii\web\HttpException($th->statusCode ?? 500, $this->message500());
        }
    }

    public function actionDelete($id){
        $model = $this->findModel($id);

        try {
            $model->delete();
            return [
                "success" => true,
                "message" => $this->messageDeleteSuccess()
            ];
        } catch (\Throwable $th) {
            if(YII_DEBUG) throw new \yii\web\HttpException($th->statusCode ?? 500, $th->getMessage());
            else  throw new \yii\web\HttpException($th->statusCode ?? 500, $this->message500());
        }
    }
}
