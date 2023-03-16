<?php

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 */


$this->title = Yii::t("cruds", 'Tambah');
$this->params['breadcrumbs'][] = ['label' => Yii::t("cruds", 'Pengguna'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <?php echo $this->render('_form', [
            'model' => $model,
        ]); ?>
    </div>
</div>