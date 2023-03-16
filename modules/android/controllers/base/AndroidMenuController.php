<?php

/**
 * Defri Indra Mahardika
 * ---- ----- --- -----
 **/

namespace app\modules\android\controllers\base;

use app\modules\android\models\AndroidMenu;
use app\modules\android\models\search\AndroidMenuSearch;
use yii\web\HttpException;
use yii\helpers\Url;
use dmstr\bootstrap\Tabs;
use Yii;
use yii\web\UploadedFile;

/**
 * AndroidMenuController implements the CRUD actions for AndroidMenu model.
 **/
class AndroidMenuController extends \app\components\productive\DefaultActiveController
{
    use \app\traits\UploadFileTrait;
    public $_redirectIndex = 1;

    /**
     * @var boolean whether to enable CSRF validation for the actions in this controller.
     * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
     **/
    public $enableCsrfValidation = false;


    /**
     * Lists all AndroidMenu models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel  = new AndroidMenuSearch;
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
     * Creates a new AndroidMenu model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $render = $this->getRenderMethod();
        $model = new AndroidMenu;
        $model->scenario = $model::SCENARIO_CREATE;

        try {
            if ($model->load($_POST)) :
                $model->name = $model->label;
                $model->params = "";

                if (Yii::$app->request->post("AndroidMenu")['params']) {
                    foreach (Yii::$app->request->post("AndroidMenu")['params'] as $param) {
                        if ($param[0] == null || $param[1] == null) {
                            continue;
                        }

                        $params[$param[0]] = $param[1];
                    }
                }

                if (count($params) != 0) {
                    $model->params = json_encode($params);
                } else {
                    $model->params = null;
                }

                $icon = UploadedFile::getInstance($model, "icon");
                if ($icon == null) {
                    Yii::$app->session->setFlash("error", "Gambar tidak boleh kosong");
                    goto end;
                }

                $response = $this->uploadImage($icon, "menu-icon");
                if ($response->success == false) {
                    Yii::$app->session->setFlash("error", "gambar gagal diunggah");
                    goto end;
                }
                $model->icon = $response->fileName;
                if ($model->validate()) :
                    $model->save();
                    toastSuccess($this->messageCreateSuccess());
                    if ($this->_redirectIndex) return $this->redirect(['index']);
                    return $this->redirect(['view', 'id' => $model->id]);
                endif;
                toastSuccess($this->message422());
            elseif (!\Yii::$app->request->isPost) :
                $model->load($_GET);
            endif;
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
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
        $old_icon = $model->icon;
        $old_param = $model->params;
        $model->scenario = $model::SCENARIO_UPDATE;

        try {
            if ($model->load($_POST)) :
                $model->name = $model->label;
                $params = [];
                $model->params = "";

                if (Yii::$app->request->post("AndroidMenu")['params']) {
                    foreach (Yii::$app->request->post("AndroidMenu")['params'] as $param) {
                        if ($param[0] == null || $param[1] == null) {
                            continue;
                        }

                        $params[$param[0]] = $param[1];
                    }
                }

                if (count($params) != 0) {
                    $model->params = json_encode($params);
                } else {
                    $model->params = $old_param;
                }

                $icon = UploadedFile::getInstance($model, "icon");
                if ($icon) {
                    $response = $this->uploadImage($icon, "menu-icon");
                    if ($response->success == false) {
                        Yii::$app->session->setFlash("error", "gambar gagal diunggah");
                        goto end;
                    }
                    $model->icon = $response->fileName;
                    $this->deleteFile($old_icon);
                } else {
                    $model->icon = $old_icon;
                }

                if ($model->validate()) :
                    $model->save();
                    toastSuccess($this->messageUpdateSuccess());
                    if ($this->_redirectIndex) return $this->redirect(['index']);
                    return $this->redirect(['view', 'id' => $model->id]);
                endif;
                toastSuccess($this->message422());
            endif;
            goto end;
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            $model->addError('_exception', $msg);
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
            \Yii::$app->getSession()->addFlash('error', $msg);
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
     * Finds the AndroidMenu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AndroidMenu the loaded model
     * @throws HttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AndroidMenu::findOne($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}
