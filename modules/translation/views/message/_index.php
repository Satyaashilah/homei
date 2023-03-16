<?php

use yii\grid\GridView;

$bahasa_list = \app\modules\translation\models\Message::find()->distinct(['language'])->select(['language'])->all();
\yii\widgets\Pjax::begin(['id' => 'pjax-main', 'enableReplaceState' => false, 'linkSelector' => '#pjax-main ul.pagination a, th a', 'clientOptions' => ['pjax:success' => 'function(){alert("yo")}']]) ?>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-3">
            <div class="card-body">
                <form onsubmit="save(event)">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>Aksi</th>
                                <th>Source</th>
                                <?php foreach ($bahasa_list as $item) : ?>
                                    <th><?= strtoupper($item->language) ?></th>
                                <?php endforeach ?>
                            </thead>
                            <tbody>
                                <?php foreach ($model as $item) : ?>
                                    <tr>
                                        <td>
                                            <button class="btn btn-success btn-xs mb-1 mr-1">
                                                <i class="fa fa-save"></i>
                                            </button>
                                        </td>
                                        <td>
                                            <?= $item->message ?>
                                        </td>
                                        <?php foreach ($bahasa_list as $lang) : ?>
                                            <td>
                                                <input style="min-width: 120px;" placeholder="<?= strtoupper($lang->language) ?>" class="form-control" type="text" name="Message[<?= $lang->language ?>][<?= $item->id ?>]" value="<?= $data[$lang->language][$item->id] ?>">
                                            </td>
                                        <?php endforeach ?>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    window.save = function(event) {
        event.preventDefault();
        var data = new FormData(event.target);

        fetch("<?= \yii\helpers\Url::to(['save']) ?>", {
                body: data,
                method: 'POST'
            }).then(response => response.json())
            .then(response => alert(response.message));
        return false;
    }
</script>
<?php \yii\widgets\Pjax::end() ?>