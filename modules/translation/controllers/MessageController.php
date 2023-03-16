<?php

namespace app\modules\translation\controllers;

/**
 * This is the class for controller "MessageController".
 * Modified by Defri Indra
 */
class MessageController extends \app\modules\translation\controllers\base\MessageController
{
    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = \app\modules\translation\models\SourceMessage::find()
            ->andWhere(['category' => \Yii::$app->request->get('kategori')])
            ->all();
        $data = \yii\helpers\ArrayHelper::map(\app\modules\translation\models\Message::find()
            ->all(), 'id', 'translation', 'language');

        return $this->render('index', [
            'model' => $model,
            'data' => $data,
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSave()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $post = \Yii::$app->request->post()['Message'];
        foreach ($post as $lang => $items) {
            foreach ($items as $id => $translation) {
                $trans = \app\modules\translation\models\Message::findOne(['language' => $lang, 'id' => $id]);
                if ($trans != null) {
                    $trans->translation = $translation;
                    $trans->save();
                }
            }
        }

        return ["success" => true, "message" => "Data berhasil di simpan"];
    }
}
