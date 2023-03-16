<?php

use app\components\Constant;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use \app\components\annex\Tabs;

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 */

$this->title = Yii::t('cruds', 'Update Profile');
$this->params['breadcrumbs'][] = $this->title;
$submit_label = '<span class="fa fa-check"></span> ' . Yii::t('cruds', 'Update Profile');
?>
<div class="giiant-crud">
    <?php $form = ActiveForm::begin([
        'id' => 'FormProfile',
        'layout' => 'horizontal',
        'enableClientValidation' => false,
        'errorSummaryCssClass' => 'error-summary alert alert-error',
        'options' => ['enctype' => 'multipart/form-data'],
    ]);
    ?>

    <div class="row">
        <div class="col-md-5 col-sm-12">
            <div class="card mb-3">
                <div class="card-body">
                    <?php if (\app\helpers\FileHelper::checkFile($model->photo_url)) : ?>
                        <div class="form-group m-auto">
                            <div class="col-sm-12 col-sm-offset-3 text-center mb-4">
                                <img id="user-img_preview" src="<?= \app\helpers\FileHelper::link($model->photo_url) ?>" class="rounded-circle" style="width: 150px;height: 150px">
                            </div>
                        </div>
                    <?php endif ?>
                    <?= $form->field($model, 'photo_url', Constant::COLUMN(1))->widget(\kartik\file\FileInput::class, [
                        'options' => ['accept' => 'image/*'],
                        'pluginOptions' => [
                            'allowedFileExtensions' => ['jpg', 'png', 'jpeg', 'gif', 'bmp'],
                            'maxFileSize' => 1024 * 1024 * 5,
                            'showUpload' => false,
                            'showRemove' => false,
                            'showClose' => false,
                            'showCaption' => true,
                            'showCancel' => false,
                            'showBrowse' => true,
                            'showPreview' => false,
                            'showZoom' => false,
                            'browseLabel' => 'Pilih Gambar'
                        ],
                    ])->label(false) ?>
                </div>
            </div>
        </div>
        <div class="col-md-7  col-sm-12">
            <div class="card mb-3">
                <div class="card-body">
                    <div id="error" class="text-danger"></div>
                    <?php echo $form->errorSummary($model); ?>
                    <div class="d-flex flex-wrap mt-3">
                        <?= $form->field($model, 'username', Constant::COLUMN(1))
                            ->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>
                        <?= $form->field($model, 'password', Constant::COLUMN(1))
                            ->passwordInput(['maxlength' => true, 'autocomplete' => "off"]) ?>
                        <?= $form->field($model, 'name', Constant::COLUMN(1))
                            ->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'email', Constant::COLUMN(1))
                            ->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'phone', Constant::COLUMN(1))
                            ->textInput(['maxlength' => true]) ?>
                    </div>

                    <hr />
                    <div class="text-right">

                        <?= Html::submitButton(
                            $submit_label,
                            [
                                'id' => 'save-' . $model->formName(),
                                'class' => 'btn btn-success',
                            ]
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php \richardfan\widget\JSRegister::begin([
    'key' => 'bootstrap-modal',
    'position' => \yii\web\View::POS_READY
]); ?>
<script>
    let submit_label = '<?= $submit_label ?>';
    $(function() {
        $('#user-photo_url').on('change', function(event) {
            var input = this;
            var url = $(this).val();
            var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#user-img_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                $('#user-img_preview').attr('src', '<?= \app\helpers\FileHelper::link($model->photo_url) ?>');
            }
        });

        $('#FormProfile').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#FormProfile #save-User').attr('disabled', true);
                    $('#FormProfile #save-User').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function(data) {
                    if (data.success == true) {
                        window.location.href = '<?= \yii\helpers\Url::to(['/site/profile']) ?>';
                    } else {
                        $('#error').html(data.message);
                        $('#FormProfile #save-User').attr('disabled', false);
                        $('#FormProfile #save-User').html(submit_label);
                    }
                },
                error: function(data) {
                    $('#error').html(data.message);
                    $('#FormProfile #save-User').attr('disabled', false);
                    $('#FormProfile #save-User').html(submit_label);
                }
            });
        });
    });
</script>
<?php \richardfan\widget\JSRegister::end(); ?>