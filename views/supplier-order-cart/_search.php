<?php
/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\search\SupplierOrderCartSearch $model
* @var yii\widgets\ActiveForm $form
*/
?>

<div class="supplier-order-cart-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    ]); ?>

    		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'kode_unik') ?>

		<?= $form->field($model, 'user_id') ?>

		<?= $form->field($model, 'material_id') ?>

		<?= $form->field($model, 'submaterial_id') ?>

		<?php // echo $form->field($model, 'supplier_barang_id') ?>

		<?php // echo $form->field($model, 'supplier_id') ?>

		<?php // echo $form->field($model, 'jumlah') ?>

		<?php // echo $form->field($model, 'volume') ?>

		<?php // echo $form->field($model, 'harga_satuan') ?>

		<?php // echo $form->field($model, 'subtotal') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<?php // echo $form->field($model, 'deleted_at') ?>

		<?php // echo $form->field($model, 'created_by') ?>

		<?php // echo $form->field($model, 'updated_by') ?>

		<?php // echo $form->field($model, 'deleted_by') ?>

		<?php // echo $form->field($model, 'flag') ?>

		<?php // echo $form->field($model, 'no_spk') ?>

		<?php // echo $form->field($model, 'keterangan_proyek') ?>

		<?php // echo $form->field($model, 'valid_spk') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('cruds', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('cruds', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
