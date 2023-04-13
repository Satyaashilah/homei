<?php

/**
 * Autogenerated From GII
 * modified by Defri Indra M
 * 2021
 */

use yii\helpers\Html;
use app\components\annex\ActiveForm;
use \app\components\annex\Tabs;
use app\components\Constant;

/**
 * @var yii\web\View $this
 * @var app\models\SupplierBarang $model
 * @var app\components\annex\ActiveForm $form
 */

?>

<?php $form = ActiveForm::begin([
	'id' => 'SupplierBarang',
	'layout' => 'horizontal',
	'enableClientValidation' => true,
	'errorSummaryCssClass' => 'error-summary alert alert-error'
]);
?>
<?php echo $form->errorSummary($model); ?>

<div class="clearfix"></div>
<div class="d-flex  flex-wrap">

	<?= $form->field($model, 'supplier_id', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'material_id', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'submaterial_id', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'nama_barang', \app\components\Constant::COLUMN())->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'slug', \app\components\Constant::COLUMN())->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'satuan_id', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'panjang', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'lebar', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'tebal', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'stok', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'harga_ritel', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'harga_proyek', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'minimal_beli_satuan', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'minimal_beli_volume', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'deskripsi', \app\components\Constant::COLUMN())->textarea(['rows' => 6]) ?>
	<?= $form->field($model, 'gambar', Constant::COLUMN(1))->fileInput([
		'options' => ['accept' => 'image/*'],
		'pluginOptions' => [
			'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
			'maxFileSize' => 250,
		],
	]) ?>
	<!-- <?= $form->field($model, 'gambar', \app\components\Constant::COLUMN())->textarea(['rows' => 6]) ?> -->
	<?= $form->field($model, 'params', \app\components\Constant::COLUMN())->textarea(['rows' => 6]) ?>
	<?= $form->field($model, 'deleted_by', \app\components\Constant::COLUMN())->textInput() ?>
	<?= $form->field($model, 'status', \app\components\Constant::COLUMN())->textInput() ?>
	<div class="clearfix"></div>
</div>
<hr />
<div class="row">
	<div class="col-md-offset-3 col-md-10">
		<?= Html::submitButton('<i class="fa fa-save"></i> ' . 'Simpan', ['class' => 'btn btn-success']); ?>
		<?php if (Yii::$app->request->isAjax == false) : ?>
			<?= Html::a('<i class="fa fa-chevron-left"></i> ' . 'Kembali', ['index'], ['class' => 'btn btn-default']) ?>
		<?php endif ?>
	</div>
</div>
<?php ActiveForm::end(); ?>