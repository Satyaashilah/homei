<?php

use app\components\ModalButton;
use dosamigos\selectize\SelectizeTextInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\search\MenuSearch $searchModel
 */

$this->title = Yii::t("cruds", 'Manajemen Menu');
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    .sorterer {
        text-align: center;
        background: <?= Yii::$app->params['color_schema']['primary'] ?>;
        color: #ffffff;
        cursor: move;
    }

    table tr.sorting-row td {
        background-color: #8b8;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="card m-b-30">
            <div class="card-header">
                <?= ModalButton::a('<i class="fa fa-plus"></i> Tambah', ['create'], ['class' => 'btn btn-info', 'title' => 'Tambah Hak Akses']) ?>
                <button id="simpanBtn" class="btn btn-success"><i class="fa fa-save"></i> <?= Yii::t('cruds', 'Simpan') ?></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="tableSorter">
                        <thead>
                            <tr>
                                <th><?= Yii::t('cruds', 'No') ?></th>
                                <th><?= Yii::t('cruds', 'Module') ?></th>
                                <th><?= Yii::t('cruds', 'Nama Menu') ?></th>
                                <th><?= Yii::t('cruds', 'Controller') ?></th>
                                <th><?= Yii::t('cruds', 'Ikon') ?></th>
                                <th><?= Yii::t('cruds', 'Induk') ?></th>
                                <th><?= Yii::t('cruds', 'Dikecualikan') ?></th>
                                <th><?= Yii::t('cruds', 'Aksi') ?></th>
                                <th style="width: 50px">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            /* @var $menu \app\models\Menu*/
                            foreach ($model as $menu) {
                                echo $this->render("_partial_row_index", [
                                    "no" => $no,
                                    "menu" => $menu,
                                    "parents" => $parents,
                                    'rowStyle' => 'background-color: #FFFCE7;',
                                ]);
                                $no++;
                                foreach ($menu['children'] as $menu2) {
                                    echo $this->render("_partial_row_index", [
                                        "no" => $no,
                                        "menu" => $menu2,
                                        "parents" => $parents,
                                    ]);
                                    $no++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs('

new RowSorter("#tableSorter", {
    handler: "td.sorterer",
});

$("#simpanBtn").click(function(){
    var arr = [];
    $("tbody tr").each(function(){
        var obj = [];
        obj.push($(this).attr("data"));
        obj.push($(this).find(".name").val());
        obj.push($(this).find(".controller").val());
        obj.push($(this).find("[name=parent_id]").val());
        obj.push($(this).find(".icon").val());
        obj.push($(this).find(".module").val());
        obj.push($(this).find("[name=except]").val());
        arr.push(obj.join("[=]"));
    });
    console.log(arr.join("||"));
    $.ajax({
        url : "' . Url::to(["save"]) . '",
        data : {
            str : arr.join("||"),
        },
        type : "post",
        success : function(data){
            if(data.success){
                alert("Data berhasil disimpan");
            } else {
                alert("Data gagal disimpan : " + data.message);
            }
        }
    });
    return false;
});

$(".icp-auto").iconpicker();

');
?>