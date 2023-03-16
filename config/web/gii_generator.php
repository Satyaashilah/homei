<?php
return [
    'migrik' => [
        'class' => \insolita\migrik\gii\StructureGenerator::class,
        // 'templates' => [
        //     'custom' => '@backend/gii/templates/migrator_schema',
        // ],
    ],
    'migrikdata' => [
        'class' => \insolita\migrik\gii\DataGenerator::class,
        // 'templates' => [
        //     'custom' => '@backend/gii/templates/migrator_data',
        // ],
    ],
    'giiant-model' => [
        // 'class' => 'schmunk42\giiant\generators\model\Generator',
        'class' => 'app\template\giiant\generators\model\Generator',
        'templates' => [
            'Annex' => '@app/template/giiant/generators/model/default',
            'default' => '@vendor/schmunk42/yii2-giiant/src//generators/model/default',
        ],
    ],
    'giiant-crud' => [
        // 'class' => 'schmunk42\giiant\generators\crud\Generator',
        'class' => 'app\template\giiant\generators\crud\Generator',
        'templates' => [
            'Annex' => '@app/template/giiant/generators/crud/default',
            'default' => '@vendor/schmunk42/yii2-giiant/src//generators/crud/default',
        ],
    ],
    'giiant-module' => [
        'class' => 'schmunk42\giiant\generators\module\Generator',
        'templates' => [
            'Annex' => '@app/template/giiant/generators/module/default',
            'default' => '@vendor/schmunk42/yii2-giiant/src//generators/module/default',
        ],
    ],
];
