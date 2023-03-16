<?php

use app\components\ModalButton;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\KategoriMenuAndroidSearch $searchModel
 */

$this->title = 'Kategori Menu Android';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= ModalButton::a('<i class="fa fa-plus"></i> Tambah Baru', ['create'], ['class' => 'btn btn-success']) ?>
</p>


<?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

<div class="card card-default">
    <div class="card-body">
        <div class="table-responsive">
            <?= GridView::widget([
                'layout' => '{summary}{items}{pager}',
                'dataProvider' => $dataProvider,
                'pager'        => [
                    'class'          => yii\widgets\LinkPager::class,
                    'firstPageLabel' => 'First',
                    'lastPageLabel'  => 'Last'
                ],
                'filterModel' => $searchModel,
                'tableOptions' => ['class' => 'table table-striped table-borderless table-hover'],
                'headerRowOptions' => ['class' => 'x'],
                'columns' => [
                    \app\components\ActionAjaxButton::getButtons(['template' => '{update} {delete}']),
                    [
                        'attribute' => 'id_reference',
                        'filter' => false,
                        'value' => function ($model) {
                            return ($rel = $model->referensi) ? $rel->category_name : "";
                        }
                    ],
                    [
                        'attribute' => 'icon',
                        'format' => 'myImage',
                        'filter' => false,
                    ],
                    'category_name',
                    [
                        'attribute' => 'order',
                        'filter' => false,
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::end() ?>