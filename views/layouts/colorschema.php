<style>
    .ui-dialog-titlebar,
    .panel-primary>.panel-heading,
    .navbar-inverse,
    .navbar-inverse .navbar-nav>.active>a,
    .navbar-inverse .navbar-nav>.open>a,
    .btn-primary,
    .btn-primary:hover,
    .label-primary,
    .pagination>.active>a,
    .nav-pills .nav-item.show .nav-link,
    .nav-pills .nav-link.active {
        color: white !important;
        border-color: <?= Yii::$app->params['color_schema']['primary'] ?> !important;
        background-color: <?= Yii::$app->params['color_schema']['primary'] ?> !important;
        background-image: -webkit-linear-gradient(top, <?= Yii::$app->params['color_schema']['primary'] ?> 0, <?= Yii::$app->params['color_schema']['primary'] ?> 100%) !important;
        background-image: -o-linear-gradient(top, <?= Yii::$app->params['color_schema']['primary'] ?> 0, <?= Yii::$app->params['color_schema']['primary'] ?> 100%) !important;
        background-image: -webkit-gradient(linear, left top, left bottom, from(<?= Yii::$app->params['color_schema']['primary'] ?>), to(<?= Yii::$app->params['color_schema']['primary'] ?>)) !important;
        background-image: linear-gradient(to bottom, <?= Yii::$app->params['color_schema']['primary'] ?> 0, <?= Yii::$app->params['color_schema']['primary'] ?> 100%) !important;
    }

    .navbar-inverse .navbar-nav>.active>a,
    .navbar-inverse .navbar-nav>.open>a {
        text-decoration: underline !important;
        font-weight: bold;
    }

    .panel-info>.panel-heading,
    .btn-info,
    .btn-info:hover,
    .label-info {
        color: white;
        border-color: <?= Yii::$app->params['color_schema']['info'] ?>;
        background-color: <?= Yii::$app->params['color_schema']['info'] ?>;
        background-image: -webkit-linear-gradient(top, <?= Yii::$app->params['color_schema']['info'] ?> 0, <?= Yii::$app->params['color_schema']['info'] ?> 100%);
        background-image: -o-linear-gradient(top, <?= Yii::$app->params['color_schema']['info'] ?> 0, <?= Yii::$app->params['color_schema']['info'] ?> 100%);
        background-image: -webkit-gradient(linear, left top, left bottom, from(<?= Yii::$app->params['color_schema']['info'] ?>), to(<?= Yii::$app->params['color_schema']['info'] ?>));
        background-image: linear-gradient(to bottom, <?= Yii::$app->params['color_schema']['info'] ?> 0, <?= Yii::$app->params['color_schema']['info'] ?> 100%);
    }

    .panel-warning>.panel-heading,
    .btn-warning,
    .btn-warning:hover,
    .label-warning {
        color: white;
        border-color: <?= Yii::$app->params['color_schema']['warning'] ?>;
        background-color: <?= Yii::$app->params['color_schema']['warning'] ?>;
        background-image: -webkit-linear-gradient(top, <?= Yii::$app->params['color_schema']['warning'] ?> 0, <?= Yii::$app->params['color_schema']['warning'] ?> 100%);
        background-image: -o-linear-gradient(top, <?= Yii::$app->params['color_schema']['warning'] ?> 0, <?= Yii::$app->params['color_schema']['warning'] ?> 100%);
        background-image: -webkit-gradient(linear, left top, left bottom, from(<?= Yii::$app->params['color_schema']['warning'] ?>), to(<?= Yii::$app->params['color_schema']['warning'] ?>));
        background-image: linear-gradient(to bottom, <?= Yii::$app->params['color_schema']['warning'] ?> 0, <?= Yii::$app->params['color_schema']['warning'] ?> 100%);
    }

    .panel-danger>.panel-heading,
    .badge,
    .btn-danger,
    .btn-danger:hover,
    .label-danger {
        color: white;
        border-color: <?= Yii::$app->params['color_schema']['danger'] ?>;
        background-color: <?= Yii::$app->params['color_schema']['danger'] ?>;
        background-image: -webkit-linear-gradient(top, <?= Yii::$app->params['color_schema']['danger'] ?> 0, <?= Yii::$app->params['color_schema']['danger'] ?> 100%);
        background-image: -o-linear-gradient(top, <?= Yii::$app->params['color_schema']['danger'] ?> 0, <?= Yii::$app->params['color_schema']['danger'] ?> 100%);
        background-image: -webkit-gradient(linear, left top, left bottom, from(<?= Yii::$app->params['color_schema']['danger'] ?>), to(<?= Yii::$app->params['color_schema']['danger'] ?>));
        background-image: linear-gradient(to bottom, <?= Yii::$app->params['color_schema']['danger'] ?> 0, <?= Yii::$app->params['color_schema']['danger'] ?> 100%);
    }

    .panel-success>.panel-heading,
    .btn-success,
    .btn-success:hover,
    .label-success {
        color: white;
        border-color: <?= Yii::$app->params['color_schema']['success'] ?>;
        background-color: <?= Yii::$app->params['color_schema']['success'] ?>;
        background-image: -webkit-linear-gradient(top, <?= Yii::$app->params['color_schema']['success'] ?> 0, <?= Yii::$app->params['color_schema']['success'] ?> 100%);
        background-image: -o-linear-gradient(top, <?= Yii::$app->params['color_schema']['success'] ?> 0, <?= Yii::$app->params['color_schema']['success'] ?> 100%);
        background-image: -webkit-gradient(linear, left top, left bottom, from(<?= Yii::$app->params['color_schema']['success'] ?>), to(<?= Yii::$app->params['color_schema']['success'] ?>));
        background-image: linear-gradient(to bottom, <?= Yii::$app->params['color_schema']['success'] ?> 0, <?= Yii::$app->params['color_schema']['success'] ?> 100%);
    }

    .panel-default>.panel-heading,
    .btn-default,
    .btn-default:hover,
    .label-default {
        color: white;
        border-color: <?= Yii::$app->params['color_schema']['default'] ?>;
        background-color: <?= Yii::$app->params['color_schema']['default'] ?>;
        background-image: -webkit-linear-gradient(top, <?= Yii::$app->params['color_schema']['default'] ?> 0, <?= Yii::$app->params['color_schema']['default'] ?> 100%);
        background-image: -o-linear-gradient(top, <?= Yii::$app->params['color_schema']['default'] ?> 0, <?= Yii::$app->params['color_schema']['default'] ?> 100%);
        background-image: -webkit-gradient(linear, left top, left bottom, from(<?= Yii::$app->params['color_schema']['default'] ?>), to(<?= Yii::$app->params['color_schema']['default'] ?>));
        background-image: linear-gradient(to bottom, <?= Yii::$app->params['color_schema']['default'] ?> 0, <?= Yii::$app->params['color_schema']['default'] ?> 100%);
    }

    .btn:hover,
    .btn:focus,
    .btn:active {
        color: white !important;
        background-image: none !important;
        text-decoration: none !important;
    }

    .login-logo>img {
        width: 33% !important;
        margin-bottom: 20px !important;
        margin-top: 30px !important;
    }

    .select2 {
        width: 100% !important;
    }

    .select2-selection__rendered {
        padding: 6px 12px !important;
    }

    .select2-container .select2-selection--single,
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #d1d7dc !important;
        height: auto !important;
    }

    .datepicker td,
    .datepicker th {
        width: 30px;
        height: 30px;
    }

    .navbar-custom,
    .button-menu-mobile {
        background-color: <?= Yii::$app->params['color_schema']['primary'] ?>;
    }

    #sidebar-menu>ul>li>a.active {
        background-color: <?= Yii::$app->params['color_schema']['primary'] ?>34;
        color: <?= Yii::$app->params['color_schema']['primary'] ?>;
    }

    #sidebar-menu>ul>li>a.active i,
    #sidebar-menu ul ul li.active a {
        color: <?= Yii::$app->params['color_schema']['primary'] ?>;
    }

    #sidebar-menu>ul>li>a:hover {
        color: <?= Yii::$app->params['color_schema']['secondary'] ?>;
        text-decoration: none;
    }

    #sidebar-menu>ul>li>a:hover i {
        color: <?= Yii::$app->params['color_schema']['secondary'] ?>;
    }

    a,
    .page-link {
        color: <?= Yii::$app->params['color_schema']['primary'] ?>;
    }

    a:hover,
    .page-link:hover {
        color: <?= Yii::$app->params['color_schema']['primary-dark'] ?>;
    }
</style>