<?php

use yii\helpers\Html;
?>

<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">
    <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
        <i class="ion-close"></i>
    </button>

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="#" class="logo">
                <?= Html::img(Yii::$app->formatter->asMyImage(Yii::$app->params['app']['logo'], false), ["height" => '36']) ?>
            </a>
        </div>
    </div>

    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">

            <?php
            $items = \app\components\SidebarMenu::getMenu(Yii::$app->user->identity->role_id);
            ?>
            <?= app\components\annex\Menu::widget(
                [
                    'options' => ['class' => 'sidebar-menu'],
                    'items' => $items,
                ]
            ) ?>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->