<?php

use kartik\date\DatePicker;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\UserSearch $searchModel
 */

$this->title = Yii::t("cruds", 'Pengguna');
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= Html::a('<i class="fa fa-plus"></i> ' . Yii::t("cruds", "Tambah"), ['create'], ['class' => 'btn btn-success']) ?>
</p>

<div class="row">
    <div class="col-md-12">

        <div class="card m-b-30">
            <div class="card-body">

                <?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

                <?= GridView::widget([
                    'layout' => '{summary}{pager}<div class="table-responsive">{items}{pager}',
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'class' => app\components\annex\LinkPager::class,
                        'firstPageLabel' => Yii::t("cruds", 'First'),
                        'lastPageLabel' => Yii::t("cruds", 'Last'),
                    ],
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table table-striped table-borderless table-hover'],
                    'headerRowOptions' => ['class' => 'x'],
                    'columns' => [
                        \app\components\ActionButton::getButtons(['template' => '{view}']),
                        'username',
                        'name',
                        [
                            'class' => yii\grid\DataColumn::class,
                            'attribute' => 'role_id',
                            'value' => function ($model) {
                                return $model->getRoleName();
                            },
                            'format' => 'raw',
                        ],
                        'registered_at:iddate',
                        \app\components\ActionButton::getButtons(['template' => '{update} {delete}']),
                    ],
                ]); ?>
                <?php \yii\widgets\Pjax::end() ?>
            </div>
        </div>

    </div>
</div>