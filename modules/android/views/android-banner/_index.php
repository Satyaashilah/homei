<?php

use yii\grid\GridView;
?>

<div class="table-responsive">
    <?= GridView::widget([
        'layout' => '{summary}{items}{pager}',
        'dataProvider' => $dataProvider,
        'pager'        => [
            'class'          => app\components\annex\LinkPager::className(),
            'firstPageLabel' => Yii::t('cruds', 'First'),
            'lastPageLabel'  => Yii::t('cruds', 'Last')
        ],
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-borderless table-hover'],
        'headerRowOptions' => ['class' => 'x'],
        'columns' => [

            \app\components\ActionAjaxButton::getButtons(['template' => '{view} {update}'], "android-banner"),

            // modified by Defri Indra
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'id_kategori',
                'value' => function ($model) {
                    if ($rel = $model->kategori) {
                        return $rel->nama_kategori;
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            // modified by Defri Indra
            [
                'class' => yii\grid\DataColumn::className(),
                'attribute' => 'id_route',
                'value' => function ($model) {
                    if ($rel = $model->route) {
                        return $rel->nama_route;
                    } else {
                        return '';
                    }
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'judul',
                'format' => 'text',
            ],
            [
                'attribute' => 'gambar',
                'format' => 'myImage',
                'filter' => false,
            ],
            // [
            //     'attribute' => 'deskripsi',
            //     'format' => 'ntext',
            // ],
            // [
            //     'attribute' => 'params',
            //     'format' => 'ntext',
            // ],
            [
                'attribute' => 'order',
                'format' => 'text',
                'filter' => false,
            ],
            \app\components\ActionAjaxButton::getButtons(['template' => '{delete}']),
        ],
    ]); ?>
</div>