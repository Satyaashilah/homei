<?php

use app\modules\android\models\AndroidMenuKategori;
use app\models\MenuAndroid;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \dmstr\bootstrap\Tabs;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\modules\android\models\AndroidMenuKategori $model
 * @var yii\widgets\ActiveForm $form
 */

$data_referensi = AndroidMenuKategori::find()->all();

?>
<?php if (Yii::$app->request->isAjax == false) : ?>
    <div class="card card-default">
        <div class="card-body">
        <?php endif ?>
        <?php $form = ActiveForm::begin(
            [
                'id' => 'AndroidMenuKategori',
                'layout' => 'horizontal',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error'
            ]
        );
        ?>
        <div class="col-md-12 text-center">
            <img src="<?= Yii::$app->formatter->asFileLink($model->icon) ?>" alt="Image" class="img img-fluid img-responsive">
        </div>
        <div class="d-flex flex-wrap">
            <?= $form->field($model, 'icon', \app\components\Constant::COLUMN(1))->widget(FileInput::class, []) ?>
            <?= $form->field($model, 'category_name', \app\components\Constant::COLUMN(3))->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'order', \app\components\Constant::COLUMN(3))->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'id_reference', \app\components\Constant::COLUMN(3))->dropDownList(ArrayHelper::map($data_referensi, 'id', 'category_name'), ['prompt' => '-- Pilih --']) ?>
        </div>
        <div class="clearfix"></div>
        <hr />
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <div class="col-md-offset-3 col-md-10">
                <?= Html::submitButton('<i class="fa fa-save"></i> Simpan', ['class' => 'btn btn-success']); ?>
                <?php if (Yii::$app->request->isAjax == false) : ?>
                    <?= Html::a('<i class="fa fa-chevron-left"></i> Kembali', ['index'], ['class' => 'btn btn-default']) ?>
                <?php endif ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php if (Yii::$app->request->isAjax == false) : ?>
        </div>
    </div>
<?php endif ?>