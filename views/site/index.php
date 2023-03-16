<?php

/* @var $this yii\web\View */

use app\components\formatter\CustomFormatter;
use app\models\MasterToko;
use app\models\Sales;
use kartik\date\DatePicker;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Dashboard';

$css = <<<CSS
.select2-selection__clear{
    margin-right:20px!important;
}
.card-body{
    border-radius:10px;
}
.card-body .main{
    font-size:28px;
}
.card-body> h5{
    font-size:14px;
}
.card-primary{
    color:#fff;
    background-color:#221d57;
}
.card-primary>.card-body>.main>i.fa {
    color:#E99409;
}
.card-secondary{
    color:#fff;
    background-color:#E99409;
}
.card-secondary>.card-body>.main>i.fa {
    color:#221d57;
}
CSS;
$this->registerCss($css);

?>


<div class="site-index">

</div>