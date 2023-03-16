<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Menu $model
 */

$this->title = Yii::t('cruds', 'Tambah');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">
    <div class="col-sm-12">
        <?php echo $this->render('_form', [
            'model' => $model,
        ]); ?>
    </div>
</div>