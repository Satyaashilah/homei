<?php

namespace app\controllers;

use app\components\productive\DefaultActiveController;
use yii\web\HttpException;
use yii\web\Request;

class MenuController extends DefaultActiveController
{
    public $_redirectIndex = 1;
    public $enableCsrfValidation = false;
    public $service;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = new \app\services\MenuService;
    }

    public function actionIndex()
    {
        $model = $this->service->getNestedData();
        $parents = $this->service->getSelect2Parent();
        return $this->render('index', compact('model', 'parents'));
    }

    public function actionCreate(Request $request)
    {
        $render = $this->getRenderMethod();
        $model = $this->service->getModel();
        $parents = $this->service->getSelect2Parent();

        try {
            if ($request->getIsPost()) {
                if ($this->service->create($model, $request)) {
                    toastSuccess($this->service->messageCreateSuccess("Menu"));
                    return $this->redirect(['index']);
                } else {
                    toastError(current($model->getFirstErrors()));
                    return $this->render('create', compact('model'));
                }
            } elseif (!\Yii::$app->request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $model->addError('_exception', $this->parseCatch($e));
        }

        return $this->$render('create', compact('model', 'parents'));
    }

    public function actionDelete(Request $request, $id)
    {
        if ($request->getIsPost()) {
            $response = $this->service->delete($id);
            if ($response['success']) {
                toastSuccess($this->service->messageDeleteSuccess("Menu"));
                return $this->redirect(['index']);
            } else {
                toastSuccess($response['message']);
                return $this->render('index', compact('model'));
            }
        }
        return $this->redirect(['index']);
    }

    public function actionSave(Request $request)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $success = $this->service->save($request);

        if ($success) {
            return ['success' => true, 'message' => $this->service->messageUpdateSuccess("Menu")];
        } else {
            return ['success' => false, 'message' => $this->service->messageUpdateFailed("Menu")];
        }
    }

    protected function findModel($id)
    {
        $model = $this->service->findById($id);
        if ($model) {
            return $model;
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
}
