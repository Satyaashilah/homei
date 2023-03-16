<?php

/**
 * Created by PhpStorm.
 * User: feb
 * Date: 30/05/16
 * Time: 00.14
 */

namespace app\components;

use yii\helpers\Html;

class ActionAjaxButton
{
    public static function getButtons($opts = [], $controller = null)
    {
        $base = [
            "buttons" => [],
            "template" => "{view} {update} {delete}",
            "visibleButtons" => [
                'view' => function ($model, $key, $index) {
                    return true;
                },
                'update' => function ($model, $key, $index) {
                    return true;
                },
                'delete' => function ($model, $key, $index) {
                    return true;
                }
            ]
        ];

        $opts = array_merge($base, $opts);

        return [
            'class' => 'yii\grid\ActionColumn',
            'template' => $opts['template'] ?? '{view} {update} {delete}',
            'buttons' => array_merge([
                'view' => function ($url, $model, $key) use ($controller) {
                    return ModalButton::a("<i class='fa fa-eye'></i>", [$controller . "/view", "id" => $model->id], ["class" => "mr-1 mb-1 btn btn-success", "title" => "Lihat Data"]);
                },
                'update' => function ($url, $model, $key) use ($controller) {
                    return ModalButton::a("<i class='fa fa-pencil'></i>", [$controller . "/update", "id" => $model->id], ["class" => "mr-1 mb-1 btn btn-warning", "title" => "Edit Data"]);
                },
                'delete' => function ($url, $model, $key) use ($controller) {
                    return Html::a("<i class='fa fa-trash'></i>", [$controller . "/delete", "id" => $model->id], [
                        "class" => "mr-1 mb-1 btn btn-danger",
                        "title" => "Hapus Data",
                        "data-confirm" => "Apakah Anda yakin ingin menghapus data ini ?",
                        //"data-method" => "GET"
                    ]);
                },
            ], $opts['buttons']),
            'visibleButtons' => array_merge([], $opts['visibleButtons']),
            'contentOptions' => ['nowrap' => 'nowrap', 'style' => 'text-align:center;min-width:60px'],
        ];
    }
}
