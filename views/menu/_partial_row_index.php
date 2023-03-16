<?php

use yii\helpers\Html;
use dosamigos\selectize\SelectizeTextInput;
use kartik\select2\Select2;

$module = Html::textInput("module", $menu['module'], ["class" => "form-control module"]);
$name = Html::textInput("name", $menu['name'], ["class" => "form-control name"]);
$controller = Html::textInput("controller", $menu['controller'], ["class" => "form-control controller"]);

$parent = Select2::widget([
    'name' => 'parent_id',
    'data' => $parents,
    'value' => $menu['parent_id'],
    'options' => [
        'placeholder' => Yii::t('cruds', 'Pilih Induk'),
        'multiple' => false,
    ],
]);
$button = "<i class='fa fa-arrows'></i>";
// delete button
$delete = Html::a('<i class="fa fa-trash"></i>', ['/menu/delete', 'id' => $menu['id']], [
    'class' => 'btn btn-danger btn-xs delete',
    'title' => Yii::t('cruds', 'Delete'),
    'data-confirm' => Yii::t('cruds', 'Are you sure you want to delete this item?'),
    'data-method' => 'post',
    'data-id' => $menu['id'],
]);
$icp = Html::textInput("icon", $menu['icon'], ["class" => "form-control icon icp-auto"]);
$except = SelectizeTextInput::widget([
    'name' => 'except',
    'value' => $menu['except'],
    'clientOptions' => [
        'delimiter' => ',', // <----- ADD THIS! ALSO, USE MASTER AS I MADE A FIX
        'plugins' => ['remove_button'],
        'valueField' => 'name',
        'labelField' => 'name',
        'searchField' => ['name'],
        'create' => true,
    ]
]); ?>
<tr style='<?= isset($rowStyle) ? $rowStyle : '' ?>' data='<?= $menu['id'] ?>'>
    <td><?= $no ?></td>
    <td><?= $module ?></td>
    <td><?= $name ?></td>
    <td><?= $controller ?></td>
    <td><?= $icp ?></td>
    <td><?= $parent ?></td>
    <td><?= $except ?></td>
    <td><?= $delete ?></td>
    <td class='sorterer'><?= $button ?></td>
</tr>