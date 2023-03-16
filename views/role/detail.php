<?php

use app\components\annex\Tabs;
use dmstr\helpers\Html;
use \yii\bootstrap\ActiveForm;
use \yii\helpers\Inflector;

/**
 * @var yii\web\View $this
 * @var app\models\Role $model
 */

$this->title = 'Hak Akses - ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hak Akses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => "Set Menu untuk " . $model->name, 'url' => ['view', 'id' => $model->id]];
?>
<?php $form = ActiveForm::begin(['id' => 'my-form']); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-header">
                <h3 class="card-title"><?= Yii::t("cruds", "Pilih Menu untuk Hak Akses") ?> <?= $model->name; ?></h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <?= Html::dropDownList("module", $module, $modules, ["id" => "module", "class" => "form-control", "prompt" => Yii::t("cruds", "-- Pilih Modul --")]) ?>
                </div>
                <?= $this->render('_partial_recursive', compact('parents')) ?>
            </div>
            <div class="card-footer">
                <button class="btn btn-info" type="button" id="select_all_btn">
                    <i class="fa fa-check"></i> <?= Yii::t("cruds", "Select/Deselect All") ?>
                </button>
                <button class="btn btn-success" type="submit">
                    <i class="fa fa-save"></i> <?= Yii::t("cruds", "Simpan") ?>
                </button>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php $this->registerJs('

$("#module").on("change", () => {
    window.location.href = "' . Yii::$app->urlManager->createUrl(["role/detail", "id" => $model->id, 'module' => '']) . '" + $("#module").val();
});

$("#select_all_btn").click(function(){
    $(".minimal").iCheck("toggle");
});

$(".select-all").on("click", function(){
    if($(this).prop("checked")){
        $(this).closest(".form-group").find(".actions").iCheck("check");
    }else{
        $(this).closest(".form-group").find(".actions").iCheck("uncheck");
    }
});

'); ?>