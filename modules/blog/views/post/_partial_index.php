<?php

use dmstr\helpers\Html;
use yii\helpers\Url;

?>
<!-- box card post -->
<div class="card d-block m-auto" style="min-width: 20vw;">
    <div style="height: 25vh;overflow:hidden">
        <img class="card-img-top" src="<?= Yii::$app->formatter->asFileLink($model->image) ?>" alt="Card image cap">
    </div>
    <div class="card-body">
        <h5 class="card-title" style="margin-bottom: 0;"><?= $model->title ?></h5>
        <p style="color: #555; font-size: .8rem"><?= Yii::$app->formatter->asIddate($model->created_at) ?></p>
        <p class="card-text"><?= $model->kilasan ?></p>
        <?= Html::a('Selengkapnya', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ubah Data', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
    </div>
</div>