<?php

/**
 * Defri Indra Mahardika
 * ---- ----- --- -----
 **/

namespace app\modules\blog\controllers\base;

use app\modules\blog\models\Post;
use app\modules\blog\models\search\PostSearch;
use yii\web\HttpException;
use yii\helpers\Url;
use dmstr\bootstrap\Tabs;
use Yii;
use yii\web\UploadedFile;

/**
 * PostController implements the CRUD actions for Post model.
 **/
class PostController extends \app\components\productive\DefaultActiveController
{
    // upload helper
    use \app\traits\UploadFileTrait;

    // dynamic message with translation
    use \app\traits\MessageTrait;

    public $_redirectIndex = 1;
    public $validation = null;

    public $enableCsrfValidation = false;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        // $this->validation = new \app\validations\PostValidation();
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new PostSearch;
        $dataProvider = $searchModel->search($_GET);

        Tabs::clearLocalStorage();

        Url::remember();
        \Yii::$app->session['__crudReturnUrl'] = null;

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }


    /**
     * Displays a single SuratBeritaAcaraSosialisasi model.
     * @param integer $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        $render = $this->getRenderMethod();
        \Yii::$app->session['__crudReturnUrl'] = Url::previous();
        Url::remember();
        Tabs::rememberActiveState();

        return $this->$render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $render = $this->getRenderMethod();
        $model = new Post;
        $model->scenario = $model::SCENARIO_CREATE;

        try {
            if ($model->load($_POST)) :
                // upload image
                $image = UploadedFile::getInstance($model, 'image');
                if ($image) :
                    $response = $this->uploadFile($image, $model->getUploadedPath());
                    if ($response->success) :
                        $model->image = $response->fileName;
                    else :
                        throw new HttpException(422, $response->message);
                    endif;
                endif;


                if ($model->validate()) :
                    $model->save();
                    $model->setKategori($model->categories);
                    toastSuccess($this->messageCreateSuccess());
                    if ($this->_redirectIndex) return $this->redirect(['index']);
                    return $this->redirect(['view', 'id' => $model->id]);
                endif;
                toastError(
                    $this->message422(
                        \app\components\Constant::flattenError(
                            $model->getErrors()
                        )
                    )
                );
            elseif (!\Yii::$app->request->isPost) :
                $model->load($_GET);
            endif;
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
            toastError($msg);
        }

        end:
        return $this->$render('create', $model->render());
    }

    /**
     * Updates an existing SuratBeritaAcaraPemasanganAlat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $render = $this->getRenderMethod();

        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_UPDATE;
        // store old image in temporary variable
        $oldImage = $model->image;
        $model->categories = $model->getKategoris()->select('id')->column();

        // only creator or admin can update
        if (!$model->isAuthor() && !\Yii::$app->user->identity->isSuperAdmin) {
            throw new HttpException(403, 'You are not allowed to perform this action.');
        }

        try {
            if ($model->load($_POST)) :
                // upload image with upload helper
                $image = UploadedFile::getInstance($model, 'image');
                if ($image) :
                    $response = $this->uploadFile($image, $model->getUploadedPath());
                    if ($response->success) :
                        $model->image = $response->fileName;
                    else :
                        throw new HttpException(422, $response->message);
                    endif;
                else :
                    $model->image = $oldImage;
                endif;

                $model->setKategori($model->categories);
                if ($model->validate()) :
                    $model->save();
                    toastSuccess($this->messageUpdateSuccess());
                    if ($this->_redirectIndex) return $this->redirect(['index']);
                    return $this->redirect(['view', 'id' => $model->id]);
                endif;
                toastError(
                    $this->message422(
                        \app\components\Constant::flattenError(
                            $model->getErrors()
                        )
                    )
                );
            endif;
            goto end;
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
            toastError($msg);
        }

        end:
        return $this->$render('update', $model->render());
    }

    /**
     * Deletes an existing SuratBeritaAcaraPemasanganAlat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $model = $this->findModel($id);
            $model->scenario = $model::SCENARIO_DELETE;
            $model->flag = 0;
            if ($model->save()) {
                $transaction->commit();
                toastSuccess($this->messageDeleteSuccess());
            } else {
                var_dump($model->getErrors());
                die;
                $transaction->rollBack();
                toastError($this->messageDeleteFailed());
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            toastError($msg);
            return $this->redirect(Url::previous());
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Post the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id, 'flag' => 1])) !== null) {
            return $model;
        } else {
            throw new HttpException(404, $this->message404());
        }
    }
}
