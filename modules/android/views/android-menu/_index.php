<?php

use yii\grid\GridView;
?>
<div class="table-responsive">
    <?= GridView::widget([
        'layout' => '{summary}{items}{pager}',
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => \app\components\annex\LinkPager::class,
            'firstPageLabel' => Yii::t('cruds', 'First'),
            'lastPageLabel' => Yii::t('cruds', 'Last')
        ],
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-borderless table-hover'],
        'headerRowOptions' => ['class' => 'x'],
        'columns' => [

            \app\components\ActionAjaxButton::getButtons(['template' => '{update}']),

            // [
            //     'attribute' => 'type',
            //     'filter' => Constant::MENU_ANDROID_TYPES
            // ],
            // [
            //     'attribute' => 'id_category',
            //     'value' => function ($model) {
            //         return $model->kategori->category_name;
            //     }
            // ],
            [
                'attribute' => 'icon',
                'format' => 'myImage',
                'filter' => false,
            ],
            // 'name',
            'label',
            // 'navigation',
            // 'order',
            // 'need_login:boolean',
        ],
    ]); ?>
</div>