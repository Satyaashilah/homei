<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\KategoriMenuAndroid $model
 */

$this->title = 'Kategori Menu Android : ' . $model->category_name . ', ' . 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Kategori Menu Android', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->category_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>

<?php echo $this->render('_form', [
    'model' => $model,
]); ?>