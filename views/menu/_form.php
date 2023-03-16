<?php

use app\components\Constant;
use yii\helpers\Html;
use app\components\annex\ActiveForm;
use dosamigos\selectize\SelectizeTextInput;
use kartik\select2\Select2;

/**
 * @var yii\web\View $this
 * @var app\models\Menu $model
 * @var yii\widgets\ActiveForm $form
 */

?>
<?php if (!Yii::$app->request->isAjax) : ?>
    <div class="card m-b-30">
        <div class="card-body">
        <?php endif ?>
        <?php $form = ActiveForm::begin(
            [
                'id' => 'Menu',
                'layout' => 'horizontal',
                'enableClientValidation' => true,
                'errorSummaryCssClass' => 'error-summary alert alert-error'
            ]
        );
        ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="d-flex flex-wrap">
            <?= $form->field($model, 'name', Constant::COLUMN(1))->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'module', Constant::COLUMN())->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'controller', Constant::COLUMN())->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'icon', Constant::COLUMN())->textInput(['class' => "form-control icp-auto", 'autocomplete' => 'off']) ?>
            <?= $form->field($model, 'parent_id', Constant::COLUMN())->widget(
                Select2::class,
                [
                    'data' => $parents,
                    'options' => ['placeholder' => 'Pilih Parent Menu'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ]
                ]
            ); ?>
            <?= $form->field($model, 'except', Constant::COLUMN(1))->widget(SelectizeTextInput::class, [
                'clientOptions' => [
                    'delimiter' => ',', // <----- ADD THIS! ALSO, USE MASTER AS I MADE A FIX
                    'plugins' => ['remove_button'],
                    'valueField' => 'name',
                    'labelField' => 'name',
                    'searchField' => ['name'],
                    'create' => true,
                ],
            ]) ?>

        </div>
        <hr>
        <div class="row">
            <div class="col-md-offset-3 col-md-7">
                <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('cruds', 'Simpan'), ['class' => 'btn btn-success']); ?>
                <?php if (!Yii::$app->request->isAjax) : ?>
                    <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('cruds', 'Kembali'), ['index'], ['class' => 'btn btn-default']) ?>
                <?php endif ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php if (!Yii::$app->request->isAjax) : ?>
        </div>
    </div>
<?php endif ?>

<?php
$this->registerJs('$(".icp-auto").iconpicker();');
?>