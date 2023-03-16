<?php

use app\components\ModalButton;
use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\RoleSearch $searchModel
 */

$this->title = 'Hak Akses';
$this->params['breadcrumbs'][] = $this->title;
?>

<p>
    <?= ModalButton::a('<i class="fa fa-plus"></i> Tambah', ['create'], ['class' => 'btn btn-success', 'title' => 'Tambah Hak Akses']) ?>
</p>

<div class="row">
    <div class="col-md-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="table-responsive">

                    <?php \yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

                    <?= GridView::widget([
                        'layout' => '{summary}{items}{pager}',
                        'dataProvider' => $dataProvider,
                        'pager' => [
                            'class' => app\components\annex\LinkPager::class,
                            'firstPageLabel' => 'First',
                            'lastPageLabel' => 'Last'
                        ],
                        'filterModel' => $searchModel,
                        'tableOptions' => ['class' => 'table table-striped table-bordered table-hover'],
                        'headerRowOptions' => ['class' => 'x'],
                        'columns' => [

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete} {role-menu}',
                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        return ModalButton::a("<i class='fa fa-pencil'></i>", ["update", "id" => $model->id], ["class" => "btn btn-warning", "title" => "Edit Data"]);
                                    },
                                    'delete' => function ($url, $model, $key) {
                                        return Html::a("<i class='fa fa-trash'></i>", ["delete", "id" => $model->id], [
                                            "class" => "btn btn-danger",
                                            "title" => "Hapus Data",
                                            "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                                            //"data-method" => "GET"
                                        ]);
                                    },
                                    'role-menu' => function ($url, $model, $key) {
                                        return Html::a("<i class='fa fa-cog'></i>", ["detail", "id" => $model->id], ["class" => "btn btn-info", "title" => "Detail"]);
                                    },
                                ],
                                'contentOptions' => ['nowrap' => 'nowrap', 'style' => 'text-align:center;width:150px']
                            ],
                            'name',
                        ],
                    ]); ?>
                    <?php \yii\widgets\Pjax::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>