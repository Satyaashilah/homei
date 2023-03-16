<?php

namespace app\controllers;

use app\components\productive\DefaultActiveController;
use Yii;
use yii\web\HttpException;
use yii\web\Request;


class RoleController extends DefaultActiveController
{
    public $enableCsrfValidation = false;
    public $roleService;
    public $menuService;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->roleService = new \app\services\RoleService();
        $this->menuService = new \app\services\MenuService();
    }

    public function actionIndex()
    {
        return $this->render('index', $this->roleService->prepareDataProvider());
    }

    public function actionCreate(Request $request)
    {
        $render = $this->getRenderMethod();
        $model = $this->roleService->getModel();

        try {
            if ($request->isPost) {
                if ($newmodel = $this->roleService->create($model, $request->post())) {
                    return $this->redirect(['index']);
                }
            } elseif (!$request->isPost) {
                $model->load($_GET);
            }
        } catch (\Exception $e) {
            $model->addError('_exception', $this->parseCatch($e));
        }

        return $this->$render('create', compact('model'));
    }

    public function actionUpdate(Request $request, $id)
    {
        $render = $this->getRenderMethod();
        $model = $this->roleService->findDataForUpdate($id);

        if (!$model) {
            throw new HttpException(404, $this->roleService->message404("Role"));
        }

        if ($request->isPost) {
            if ($newmodel = $this->roleService->update($model, $request->post())) {
                return $this->redirect(['index']);
            }
        } elseif (!$request->isPost) {
            $model->load($_GET);
        }

        return $this->$render('update', compact('model'));
    }

    public function actionDelete($id)
    {
        try {
            $response = $this->roleService->delete($id);
            if ($response['success']) {
                toastSuccess($this->roleService->messageDeleteSuccess("Role"));
            } else {
                toastError($this->roleService->messageDeleteFailed("Role"));
            }
        } catch (\Exception $e) {
            \Yii::$app->getSession()->setFlash('error', $this->parseCatch($e));
        }

        return $this->redirect(['index']);
    }

    public function actionDetail(Request $request, int $id, string $module = null)
    {
        $model = $this->findModel($id);

        if ($module && $request->getIsPost()) {
            if ($this->roleService->detail($model, $request->post(), $module)) {
                toastSuccess($this->roleService->messageUpdateSuccess("Hak Akses"));
                return $this->redirect(['index']);
            } else {
                toastError($this->roleService->messageUpdateFailed("Hak Akses"));
            }
        }

        $modules = $this->menuService->findAllModule();
        $modules = $this->menuService->prepareForView($modules);
        $modules += ["ALL" => Yii::t("cruds", "Tampilkan Semua")];
        $parent_id = $this->menuService->getModuleParentID($module);
        $parents = $this->roleService->getAllChild($module, $id, $parent_id);

        // var_dump($parents);die;


        return $this->render('detail', compact('model', 'modules', 'parents', 'module'));
    }

    protected function findModel($id)
    {
        if (($model = $this->roleService->findById($id)) !== null) {
            return $model;
        } else {
            throw new HttpException(404, $this->message404("Role"));
        }
    }
}
