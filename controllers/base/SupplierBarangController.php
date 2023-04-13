<?php

/**
 * Defri Indra Mahardika
 * ---- ----- --- -----
 **/

namespace app\controllers\base;

use app\models\SupplierBarang;
use app\models\search\SupplierBarangSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use Yii;
use app\components\UploadFile;
use yii\web\UploadedFile;

/**
 * SupplierBarangController implements the CRUD actions for SupplierBarang model.
 **/
class SupplierBarangController extends \app\components\productive\DefaultActiveController
{
    // dynamic message with translation
    use \app\traits\MessageTrait;

    public $_redirectIndex = 1;
    public $validation = null;

    public $enableCsrfValidation = false;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        // $this->validation = new \app\validations\SupplierBarangValidation();
    }

    /**
     * Lists all SupplierBarang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new SupplierBarangSearch;
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


    public function actionCreate()
    {
        $render = $this->getRenderMethod();
        $model = new SupplierBarang;
        $model->scenario = $model::SCENARIO_CREATE;

        try {
            if ($model->load($_POST)) :
                $gambars = UploadedFile::getInstance($model, 'gambar');
                if ($gambars != NULL) {
                    # store the source fotos name
                    $model->gambar = $gambars->name;
                    $arr = explode(".", $gambars->name);
                    $extension = end($arr);

                    # generate a unique fotos name
                    $model->gambar = Yii::$app->security->generateRandomString() . ".{$extension}";

                    # the path to save fotos
                    // unlink(Yii::getAlias("@app/web/uploads/pengajuan/") . $oldFile);
                    if (file_exists(Yii::getAlias("@app/web/uploads/gambar_produk/")) == false) {
                        mkdir(Yii::getAlias("@app/web/uploads/gambar_produk/"), 0777, true);
                    }
                    $path = Yii::getAlias("@app/web/uploads/gambar_produk/") . $model->gambar;
                    $gambars->saveAs($path);
                }
                if ($model->validate()) :
                    $model->save();
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
        $oldGambar = $model->gambar;
        try {
            if ($model->load($_POST)) :
                $gambars = UploadedFile::getInstance($model, 'gambar');
                if ($gambars != NULL) {
                    # store the source fotos name
                    $model->gambar = $gambars->name;
                    $arr = explode(".", $gambars->name);
                    $extension = end($arr);

                    # generate a unique fotos name
                    $model->gambar = Yii::$app->security->generateRandomString() . ".{$extension}";

                    # the path to save fotos
                    // unlink(Yii::getAlias("@app/web/uploads/pengajuan/") . $oldFile);
                    if (file_exists(Yii::getAlias("@app/web/uploads/gambar_produk/")) == false) {
                        mkdir(Yii::getAlias("@app/web/uploads/gambar_produk/"), 0777, true);
                    }
                    $path = Yii::getAlias("@app/web/uploads/gambar_produk/") . $model->gambar;
                    $gambars->saveAs($path);
                }
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
            $model->delete();

            $transaction->commit();
            toastSuccess($this->messageDeleteSuccess());
        } catch (\Exception $e) {
            $transaction->rollBack();
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            toastError($msg);
            return $this->redirect(Url::previous());
        }

        // TODO: improve detection
        $isPivot = strstr('$id', ',');
        if ($isPivot == true) :
            return $this->redirect(Url::previous());
        elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/') :
            Url::remember(null);
            $url = \Yii::$app->session['__crudReturnUrl'];
            \Yii::$app->session['__crudReturnUrl'] = null;

            return $this->redirect($url);
        else :
            return $this->redirect(['index']);
        endif;
    }

    /**
     * Finds the SupplierBarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SupplierBarang the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SupplierBarang::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, $this->message404());
        }
    }
}
