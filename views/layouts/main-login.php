<?php

use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

\app\assets\AnnexAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <link rel="icon" type="image/png" href=<?= \Yii::$app->request->baseUrl . "/uploads/logo.png" ?> />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script>
        var baseUrl = "<?= Yii::$app->urlManager->baseUrl ?>";
    </script>
    <?php $this->head() ?>
    <?= $this->render('colorschema') ?>
    <style>
        .accountbg {
            background-image: url(<?= Yii::$app->params['app']['login_background'] ?>);
            background-size: cover;
        }

        .form-group {
            position: relative;
        }

        .form-control-feedback {
            position: absolute;
            top: .5rem;
            right: .5rem;
            font-size: 1.2rem;
        }
    </style>
</head>

<body class="fixed-left">
    <?php $this->beginBody() ?>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page" style="margin-top:5%">

        <div class="card">

            <div class="login-logo">
                <?= Html::img(Yii::$app->formatter->asMyImage(Yii::$app->params['app']['logo'], false), ["style" => "width:100%", "class" => "d-block m-auto img img-responsive"]) ?>
            </div>
            <div class="card-body">
                <?= $content ?>

            </div>
        </div>
        <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>