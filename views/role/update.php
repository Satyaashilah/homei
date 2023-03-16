<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Role $model
 */

$this->title = 'Hak Akses ' . $model->name . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<?php if (Yii::$app->request->isAjax == false) : ?>
    <div class="card mb-3">
        <div class="card-body">
        <?php endif ?>
        <?php echo $this->render('_form', [
            'model' => $model,
        ]); ?>
        <?php if (Yii::$app->request->isAjax == false) : ?>
        </div>
    </div>
<?php endif ?>