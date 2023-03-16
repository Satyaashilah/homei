<?php

if ($model->params) $parameter_value = json_decode($model->params);
?>
<?php if (count($params) == 0) : ?>
<?php else : ?>
    <div class="table-responsive">
        <table class="table table-hover table-stripped table-bordered">
            <thead style="background-color: <?= Yii::$app->params['color_schema']['primary'] ?>;color: #fff;">
                <th style="width: 25vw"><?= Yii::t("cruds", "Parameter") ?></th>
                <th style="width: 75vw"><?= Yii::t("cruds", "Nilai") ?></th>
            </thead>
            <tbody class="container-items">
                <?php foreach ($params as $i => $param) : ?>
                    <?php
                    if ($model->isNewRecord == false) {
                        $$param = $parameter_value->$param;
                    } else {
                        $$param = 0;
                    }
                    ?>
                    <tr class="item">
                        <td>
                            <?= $param ?>
                        </td>
                        <td>
                            <?= $form->field($model, "params[$param]", ["template" => "{input}"])->textInput(['value' => $$param, "required" => "required"]); ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php endif ?>