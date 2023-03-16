<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\MenuAndroid $model
 */

$this->title = Yii::t('cruds', 'Menu Android') . ' ' . $model->name . ', ' . Yii::t('cruds', 'Ubah');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Menu Android'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Ubah');
?>
<?php echo $this->render('_form', [
    'model' => $model,
]); ?>