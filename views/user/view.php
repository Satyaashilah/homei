<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use \app\components\annex\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 */

$this->title = Yii::t("cruds", 'Pengguna') . " " . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t("cruds", 'Pengguna'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t("cruds", 'Detail');
?>
<div class="giiant-crud user-view">

    <!-- menu buttons -->
    <p class='pull-left'>
        <?= Html::a('<span class="fa fa-pencil"></span> ' . Yii::t("cruds", 'Ubah'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('<span class="fa fa-plus"></span> ' . Yii::t("cruds", 'Tambah'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="pull-right">
        <?= Html::a('<span class="fa fa-list"></span> ' . Yii::t("cruds", 'List Pengguna'), ['index'], ['class' => 'btn btn-default']) ?>
    </p>

    <div class="clearfix"></div>



    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <?php if (\app\helpers\FileHelper::checkFile($model->photo_url)) : ?>
                        <div class="form-group m-auto">
                            <div class="col-sm-12 col-sm-offset-3 text-center mb-4">
                                <img id="user-img_preview" src="<?= \app\helpers\FileHelper::link($model->photo_url) ?>" class="rounded-circle" style="width: 150px;height: 150px">
                            </div>
                        </div>
                    <?php endif ?>

                    <?= DetailView::widget([
                        'model' => $model,
                        'options' => ['class' => 'table table-striped table-borderless'],
                        'attributes' => [
                            'username',
                            [
                                'format' => 'html',
                                'attribute' => 'role_id',
                                'value' => function ($model) {
                                    return $model->roleName;
                                }
                            ],
                            'last_login:iddate',
                            'last_logout:iddate',
                            'registered_at:iddate',
                        ],
                    ]); ?>

                    <hr />

                    <?= Html::a(
                        '<span class="fa fa-trash"></span> ' . 'Delete',
                        ['delete', 'id' => $model->id],
                        [
                            'class' => 'btn btn-danger',
                            'data-confirm' => '' . 'Are you sure to delete this item?' . '',
                            'data-method' => 'post',
                        ]
                    ); ?>
                </div>
            </div>
        </div>
    </div>
</div>