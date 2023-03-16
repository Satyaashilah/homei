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
            [
                'attribute' => 'nama_kategori',
                'format' => 'text',
            ],
            \app\components\ActionAjaxButton::getButtons(['template' => '{update} {delete}'], "android-banner-kategori"),
        ],
    ]); ?>
</div>