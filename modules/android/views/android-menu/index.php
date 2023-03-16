<?php

use app\components\Constant;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\MenuAndroidSearch $searchModel
 */

$this->title = Yii::t('cruds', 'Menu Android');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t('cruds', 'Tambah Baru'), ['create'], ['class' => 'btn btn-success']) ?>
</p>


<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

<div class="card card-default">
    <div class="card-body">
        <?= $this->render('_index', ['dataProvider' => $dataProvider]); ?>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>