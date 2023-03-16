<?php

use app\components\Constant;
use app\modules\android\models\AndroidMenuKategori;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\modules\android\models\AndroidMenu $model
 * @var yii\widgets\ActiveForm $form
 */

?>
<style>
    .add-one {
        background-color: #12B255;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        ;
    }

    .delete {
        background-color: #C81232;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        ;
    }
</style>
<?php if (Yii::$app->request->isAjax == false) : ?>
    <div class="card card-default">
        <div class="card-body">
        <?php endif ?>
        <?php $form = ActiveForm::begin([
            'id' => 'AndroidMenu',
            'layout' => 'horizontal',
            'enableClientValidation' => true,
            'errorSummaryCssClass' => 'error-summary alert alert-error',
        ]);
        ?>

        <?php if ($model->icon != null) : ?>
            <div class="d-block m-auto" style="text-align: center;">
                <?= Yii::$app->formatter->asMyImage($model->icon) ?>
            </div>
        <?php endif ?>
        <div class="d-flex flex-wrap">
            <?= $form->field($model, 'icon', Constant::COLUMN(1))->widget(FileInput::class, [
                "pluginOptions" => [
                    'accept' => 'image/*'
                ]
            ]) ?>
            <hr>
            <div class="clearfix"></div>
            <?= $form->field($model, 'id_category', Constant::COLUMN(1))->dropDownList(ArrayHelper::map(AndroidMenuKategori::find()->all(), 'id', 'category_name'), ['prompt' => '-- Pilih --']) ?>
            <?php // $form->field($model, 'name', Constant::COLUMN())->textInput(['maxlength' => true]) 
            ?>
            <?= $form->field($model, 'label', Constant::COLUMN(1))->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'need_login', Constant::COLUMN())->dropDownList(['Tidak', 'Ya']) ?>
            <?= $form->field($model, 'navigation', Constant::COLUMN())->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'order', Constant::COLUMN())->textInput(['type' => 'number']) ?>
            <?= $form->field($model, 'type', Constant::COLUMN())->dropDownList($model::MENU_ANDROID_TYPES, ['prompt' => '-- Pilih --']) ?>
        </div>
        <div class="clearfix"></div>
        <hr />
        <div class="clearfix"></div>
        <div class="table-responsive">
            <table class="table table-stripped table-bordered">
                <thead style="background-color: rgb(0, 20, 100);color:white">
                    <th style="color:white"><?= Yii::t('cruds', 'Nama') ?></th>
                    <th style="color:white"><?= Yii::t('cruds', 'Nilai') ?></th>
                    <td style="text-align:center">
                        <span class="add-one"><i class="fa fa-plus"></i></span>
                        <span class="delete"><i class="fa fa-minus"></i></span>
                    </td>
                </thead>
                <tbody class="dynamic-stuff">
                    <?php if ($model->params != null) :
                        $i = 0; ?>
                        <?php foreach (json_decode($model->params) as $key => $val) : ?>
                            <tr class="dynamic-element">
                                <td>
                                    <?= $form->field($model, "params[$i][0]", Constant::COLUMN(1))->textInput(['value' => $key, 'style' => 'min-width:150px'])->label(false) ?>
                                </td>
                                <td>
                                    <?= $form->field($model, "params[$i][1]", Constant::COLUMN(1))->textInput(['value' => $val, 'style' => 'min-width:150px'])->label(false) ?>
                                </td>
                                <td style="text-align:center">
                                    <span class="add-one"><i class="fa fa-plus"></i></span>
                                    <span class="delete"><i class="fa fa-minus"></i></span>
                                </td>
                            </tr>
                        <?php $i++;
                        endforeach ?>
                    <?php else : ?>
                        <tr class="dynamic-element">
                            <td>
                                <?= $form->field($model, "params[0][0]", Constant::COLUMN(1))->textInput()->label(false) ?>
                            </td>
                            <td>
                                <?= $form->field($model, "params[0][1]", Constant::COLUMN(1))->textInput()->label(false) ?>
                            </td>
                            <td style="text-align:center">
                                <span class="add-one"><i class="fa fa-plus"></i></span>
                                <span class="delete"><i class="fa fa-minus"></i></span>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="clearfix"></div>
        <hr>
        <?php echo $form->errorSummary($model); ?>
        <div class="row">
            <div class="col-md-offset-3 col-md-10">
                <?= Html::submitButton('<i class="fa fa-save"></i> ' . Yii::t('cruds', 'Simpan'), ['class' => 'btn btn-success']); ?>
                <?php if (Yii::$app->request->isAjax == false) : ?>
                    <?= Html::a('<i class="fa fa-chevron-left"></i> ' . Yii::t('cruds', 'Kembali'), ['index'], ['class' => 'btn btn-default']) ?>
                <?php endif ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php if (Yii::$app->request->isAjax == false) : ?>
        </div>
    </div>
<?php endif ?>

<?php
$template = '<tr class="dynamic-element">
<td>
    <div class="col-md-12 field-androidmenu-params-0-0" style="padding:0px;">
<div class="col-lg-12">
<div class="col-md-12"></div>
<div class="col-md-12"><input type="text" id="androidmenu-params-0-0" class="form-control" name="AndroidMenu[params][0][0]" value="name"><p class="help-block help-block-error "></p></div>
</div>
</div>                                </td>
<td>
    <div class="col-md-12 field-androidmenu-params-0-1" style="padding:0px;">
<div class="col-lg-12">
<div class="col-md-12"></div>
<div class="col-md-12"><input type="text" id="androidmenu-params-0-1" class="form-control" name="AndroidMenu[params][0][1]" value="defri"><p class="help-block help-block-error "></p></div>
</div>
</div>                                </td>
<td>
<span class="add-one"><i class="fa fa-plus"></i></span>
<span class="delete"><i class="fa fa-minus"></i></span>
</td>
</tr>';
$this->registerJs("
$(document).ready(function(){
    let i=" . (isset($i) ? $i : 1) . ";
    $('.add-one').click(function(){
        let cloning=$(`$template`);
        cloning.find('#androidmenu-params-0-0')[0].setAttribute('name','AndroidMenu[params]['+i+'][0]');
        cloning.find('#androidmenu-params-0-1')[0].setAttribute('name','AndroidMenu[params]['+i+'][1]');
        cloning.find('#androidmenu-params-0-0')[0].value='';
        cloning.find('#androidmenu-params-0-1')[0].value='';
        cloning.appendTo('.dynamic-stuff').show();
        i++;
        attach_add();
        attach_delete();
    });

    function attach_add(){
        $('.add-one').off();
        $('.add-one').click(function(){
            let cloning=$(`$template`);
            cloning.find('#androidmenu-params-0-0')[0].setAttribute('name','AndroidMenu[params]['+i+'][0]');
            cloning.find('#androidmenu-params-0-1')[0].setAttribute('name','AndroidMenu[params]['+i+'][1]');
            cloning.find('#androidmenu-params-0-0')[0].value='';
            cloning.find('#androidmenu-params-0-1')[0].value='';
            cloning.appendTo('.dynamic-stuff').show();
            i++;
            attach_add();
            attach_delete();
        });
    }
    
    $('.delete').click(function(){
        $('.delete').off();
        $(this).closest('.dynamic-element').remove();
        attach_add();
        attach_delete();
    });

    function attach_delete(){
        $('.delete').off();
        $('.delete').click(function(){
            $(this).closest('.dynamic-element').remove();
        });
    }
});
");
