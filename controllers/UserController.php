<?php

namespace app\controllers;

use app\components\productive\DefaultActiveController;
use yii\helpers\Url;
use yii\web\HttpException;
use \Yii;
use yii\web\Request;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends DefaultActiveController
{
    public $userService = null;
    public $enableCsrfValidation = false;

    function __construct($id, $module = null)
    {
        parent::__construct($id, $module);
        $this->userService = new \app\services\UserService();
    }

    public function actionIndex(Request $request)
    {
        return $this->render('index', $this->userService->getDataProvider($request->get()));
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', compact('model'));
    }

    public function actionCreate(Request $request)
    {
        $model = $this->userService->getModel();

        try {
            if ($request->getIsAjax()) {
                if ($model = $this->userService->create($model, $request->post())) {
                    return $this->asJson([
                        'success' => true,
                        'message' => $this->userService->messageCreateSuccess("Profile"),
                        'data' => [
                            'redirect' => Url::to(['/user/view', 'id' => $model->id]), 'code' => 201
                        ]
                    ]);
                } else {
                    $error = \Yii::$app->session->getFlash('error');
                    if (is_array($error)) {
                        $error = $error[0];
                    }
                    return $this->asJson([
                        'success' => false,
                        'message' => $error,
                    ]);
                }
            } else if ($request->getIsPost()) {
                if ($model = $this->userService->create($model, $request->post())) {
                    toastSuccess('User created successfully');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                toastError('User created failed');
            }
        } catch (\Exception $e) {
            toastError($this->parseCatch($e));
        }

        return $this->render('create', compact('model'));
    }

    public function actionUpdate(Request $request, $id)
    {
        $model = $this->userService->findDataForUpdate($id);
        if (!$model) {
            throw new HttpException(404, 'The requested page does not exist.');
        }

        if ($request->getIsAjax()) {
            if ($model = $this->userService->update($model, $request->post())) {
                return $this->asJson([
                    'success' => true,
                    'message' => $this->userService->messageUpdateSuccess("Profile"),
                    'data' => [
                        'redirect' => Url::to(['/user/view', 'id' => $model->id]), 'code' => 201
                    ]
                ]);
            } else {
                $error = \Yii::$app->session->getFlash('error');
                if (is_array($error)) {
                    $error = $error[0];
                }
                return $this->asJson([
                    'success' => false,
                    'message' => $error,
                ]);
            }
        } else if ($request = Yii::$app->request->post()) {
            if ($model = $this->userService->update($model, $request->post())) {
                toastSuccess($this->userService->messageUpdateSuccess("Profile"));
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                toastError($this->userService->messageUpdateFailed("Profile"));
            }
        }

        return $this->render('update', compact('model'));
    }

    public function actionDelete($id)
    {
        try {
            if ($this->userService->delete($id)) {
                toastSuccess($this->userService->messageDeleteSuccess("Profile"));
            } else {
                toastError($this->userService->messageDeleteFailed("Profile"));
            }
        } catch (\Exception $e) {
            toastError($this->parseCatch($e));
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if ($model = $this->userService->findById($id)) {
            return $model;
        } else {
            throw new HttpException(404, $this->userService->message404());
        }
    }
}
