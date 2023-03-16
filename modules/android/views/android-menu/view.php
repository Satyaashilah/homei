<?php

use dmstr\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use dmstr\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\MenuAndroid $model
 */

$this->title = Yii::t('cruds', 'Menu Android') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Menu Android'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('cruds', 'Detail');
?>
<?php if (Yii::$app->request->isAjax == false) : ?>
    <div class="card card-default">
        <div class="card-body">

            <div class="giiant-crud menu-android-view">

                <!-- menu buttons -->
                <p class='pull-left'>
                    <?= Html::a('<span class="fa fa-pencil"></span> ' . Yii::t('cruds', 'Ubah'), ['update', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
                    <?= Html::a('<span class="fa fa-plus"></span> ' . Yii::t('cruds', 'Tambah Baru'), ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <p class="pull-right">
                    <?= Html::a('<span class="fa fa-list"></span> ' . Yii::t('cruds', 'Daftar Menu Android'), ['index'], ['class' => 'btn btn-default']) ?>
                </p>
            <?php endif ?>

            <div class="clearfix"></div>

            <!-- flash message -->
            <?php if (\Yii::$app->session->getFlash('deleteError') !== null) : ?>
                <span class="alert alert-info alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <?= \Yii::$app->session->getFlash('deleteError') ?>
                </span>
            <?php endif; ?>

            <div class="box box-info">
                <div class="box-body">
                    <?php $this->beginBlock('app\models\MenuAndroid'); ?>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // 'id',
                            'name',
                            'label',
                            'icon:myImage',
                            'need_login:boolean',
                            'navigation',
                            'order',
                            'created_at:iddate',
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
                    <?php $this->endBlock(); ?>



                    <?= Tabs::widget(
                        [
                            'id' => 'relation-tabs',
                            'encodeLabels' => false,
                            'items' => [[
                                'label'   => '<b class=""># ' . $model->id . '</b>',
                                'content' => $this->blocks['app\models\MenuAndroid'],
                                'active'  => true,
                            ],]
                        ]
                    );
                    ?>
                </div>
            </div>
            <?php if (Yii::$app->request->isAjax == false) : ?>
            </div>
        </div>
    </div>
<?php endif ?>