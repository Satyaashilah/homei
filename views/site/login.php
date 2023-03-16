<?php

use richardfan\widget\JSRegister;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\LoginForm */

$this->title = 'Masuk - ' . Yii::$app->name;

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span id='passwordicon' class='fa fa-eye-slash form-control-feedback'></span>"
];
?>

<div class="login-box">
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Silakan masukkan username & password</p>

        <p id="error" class="text-danger"></p>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'enableClientScript' => false, // disable client script, will trigger twice submit when it true
        ]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

        <?= $form->field($model, 'captcha')->widget(
            \himiklab\yii2\recaptcha\ReCaptcha3::class,
            [
                'action' => 'login',
            ]
        )->label(false) ?>
        <hr>

        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <!-- /.col -->
            <div class="col-sm-4">
                <?= Html::submitButton('<i class="fa fa-lock"></i> Masuk', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
        </div>


        <?php ActiveForm::end(); ?>

    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->

<?php JSRegister::begin() ?>
<script>
    $('#passwordicon').on('click', function() {
        if ($('#loginform-password').attr('type') == 'password') {
            $('#loginform-password').attr('type', 'text');
            $('#passwordicon').removeClass('fa-eye-slash').addClass('fa-eye');
        } else {
            $('#loginform-password').attr('type', 'password');
            $('#passwordicon').removeClass('fa-eye').addClass('fa-eye-slash');
        }
    });

    function reloadRecaptcha() {
        grecaptcha.ready(function() {
            grecaptcha.execute("<?= Yii::$app->params['app']['recaptchaClientKey'] ?>", {
                action: "login"
            }).then(function(token) {
                jQuery("#" + "<?= strtolower($model->formName()) . "-" . "captcha" ?>").val(token);
            });
        });
    }

    $('#login-form').on('submit', function(e) {
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
                $('#login-form .btn').attr('disabled', true);
                $('#login-form .btn').html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function(data) {
                if (data.success) {
                    window.location.href = baseUrl + '/site/index';
                } else {
                    $('#error').html(data.message);
                    $('#login-form .btn').attr('disabled', false);
                    $('#login-form .btn').html('Login');
                    reloadRecaptcha();
                }
            },
            error: function(data) {
                $('#error').html(data.message);
                $('#login-form .btn').attr('disabled', false);
                $('#login-form .btn').html('Login');
                reloadRecaptcha();
            }
        });

        return false;
    });
</script>
<?php JSRegister::end() ?>