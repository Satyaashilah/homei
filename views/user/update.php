<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 */

$this->title = Yii::t("cruds", 'Pengguna') . ' ' . $model->name . ' - ' . Yii::t("cruds", 'Ubah');
$this->params['breadcrumbs'][] = ['label' => Yii::t("cruds", 'Pengguna'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t("cruds", 'Ubah');
?>

<div class="row">
    <div class="col-md-12">
        <?php echo $this->render('_form', [
            'model' => $model,
        ]); ?>
    </div>
</div>