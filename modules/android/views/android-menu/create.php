<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\MenuAndroid $model
 */

$this->title = Yii::t('cruds', 'Tambah Baru');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Menu Android'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->request->isAjax == false) : ?>
    <p>
        <?= Html::a('Kembali', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
    </p>
<?php endif ?>

<?= $this->render('_form', [
    'model' => $model,
]); ?>