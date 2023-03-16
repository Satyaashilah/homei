<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use \app\components\annex\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\Role $model
 * @var yii\widgets\ActiveForm $form
 */

?>

<?php $form = ActiveForm::begin(
    [
        'id' => 'Role',
        'layout' => 'horizontal',
        'enableClientValidation' => true,
        'errorSummaryCssClass' => 'error-summary alert alert-error'
    ]
);
?>
<?php echo $form->errorSummary($model); ?>

<div class="d-flex flex-wrap">
    <?= $form->field($model, 'name', \app\components\Constant::COLUMN(1))->textInput(['maxlength' => true]) ?>
</div>

<hr />
<div class="row">
    <div class="col-md-offset-3 col-md-7">
        <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('cruds', 'Simpan'), ['class' => 'btn btn-success']); ?>
        <?php if (!Yii::$app->request->isAjax) : ?>
            <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('cruds', 'Kembali'), ['index'], ['class' => 'btn btn-default']) ?>
        <?php endif ?>
    </div>
</div>

<?php ActiveForm::end(); ?>