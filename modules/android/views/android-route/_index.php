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

            \app\components\ActionAjaxButton::getButtons(['template' => '{view} {update}']),

            [
                'attribute' => 'nama_route',
                'format' => 'text',
            ],
            [
                'attribute' => 'params',
                'format' => 'ntext',
                'filter' => false,
            ],
            [
                'attribute' => 'keterangan',
                'format' => 'ntext',
                'filter' => false,
            ],
            [
                'attribute' => 'butuh_login',
                'format' => 'boolean',
            ],
            \app\components\ActionAjaxButton::getButtons(['template' => '{delete}']),
        ],
    ]); ?>
</div>