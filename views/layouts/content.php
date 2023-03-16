<?php

use app\components\annex\Breadcrumbs;
use richardfan\widget\JSRegister;

?>

<?php \app\components\annex\Modal::begin(['id' => 'modal', 'header' => '<h3 id="modaltitle"></h3>', 'size' => 'modal-lg', 'options' => ['tabindex' => '']]) ?>
<div id="modalbody"></div>
<?php \app\components\annex\Modal::end() ?>

<div class="page-content-wrapper ">

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="btn-group float-right">
                        <?= Breadcrumbs::widget(
                            [
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]
                        ) ?>
                    </div>
                    <h2 class="page-title">
                        <?php
                        if ($this->title !== null) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camel2words(
                                \yii\helpers\Inflector::id2camel($this->context->module->id)
                            );
                            echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                        } ?>
                    </h2>
                </div>
            </div>
        </div>
        <!-- end page title end breadcrumb -->

        <div class="content-wrapper">
            <section class="content">
                <?= $content ?>
            </section>
        </div>
    </div><!-- container -->


</div> <!-- Page content Wrapper -->

<footer class="footer">
    <div class="pull-right hidden-xs">
        <b><?= Yii::t("cruds", "Version") ?></b> <?= Yii::$app->params['app']['version'] ?? "1.0" ?>
    </div>
    <strong>Copyright &copy; <?= date('Y') ?> <a href="#"><?= Yii::$app->params['app']['copyright'] ?></a>.</strong> All rights
    reserved.
</footer>

<?php
// $this->registerJsFile("@web/swal/sweetalert2.all.min.js");
$data_flash_success = \Yii::$app->session->getFlash('success');
$data_flash_error = \Yii::$app->session->getFlash('error');


$data = [];
if (gettype($data_flash_success) == 'string') {
    $data[] = [
        "title" => "Berhasil !",
        "text" => $data_flash_success,
        "icon" => "success",
    ];
} else if (gettype($data_flash_success) == "array") {
    foreach ($data_flash_success as $item) {
        $data[] = [
            "title" => "Berhasil !",
            "text" => $item,
            "icon" => "success",
        ];
    }
}

if (gettype($data_flash_error) == 'string') {
    $data[] = [
        "title" => "Gagal !",
        "text" => $data_flash_error,
        "icon" => "error",
    ];
} else if (gettype($data_flash_error) == "array") {
    foreach ($data_flash_error as $item) {
        $data[] = [
            "title" => "Gagal !",
            "text" => $item,
            "icon" => "error",
        ];
    }
}

?>
<?php JSRegister::begin(); ?>
<script>
    $(function() {
        $('.modalButton').click(function() {
            console.log($(this).attr('value'));
            $('#modal').modal('show')
                .find('#modalContent')
                .load($(this).attr('value'));
        });

        $("#modal").on("hide.bs.modal", function() {
            if (typeof tinyMCE !== 'undefined') {
                if (tinyMCE.activeEditor) {
                    tinyMCE.activeEditor.remove();
                }
            }
        });
    })

    window.openmodal = function(href, title = "Modal") {
        $.ajax(href, {
            success: function(response) {
                $('#modaltitle').html(title);
                $('#modalbody').html(response);
                $('#modal').modal({
                    show: 1
                });
            },
            error: function(response) {
                $('#modaltitle').html(response.statusText);
                $('#modalbody').html(response.responseText);
                $('#modal').modal({
                    show: 1
                });
            }
        })
    }

    yii.confirm = function(message, okCallback, cancelCallback) {
        // swal fires the callback when the user clicks on the confirm button
        Swal.fire({
            title: "<?= Yii::t("cruds", "Are you sure ?") ?>",
            text: message,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= Yii::t("cruds", "Yes") ?>",
            cancelButtonText: "<?= Yii::t("cruds", "No") ?>",
        }).then((result) => {
            if (result.isConfirmed) {
                okCallback();
            }
        });
    };

    window.alert = function(message) {
        Swal.fire({
            title: "<?= Yii::t("cruds", "Information !") ?>",
            text: message,
            icon: "info",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?= Yii::t("cruds", "Ok") ?>",
        });
    };

    $(document).ready(function() {
        var list_popup = <?= json_encode($data) ?>;
        if (list_popup == null) {
            list_popup = [];
        }

        Swal.queue(list_popup);
    });
</script>
<?php JSRegister::end(); ?>