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
    <link rel="icon" type="image/png" href=<?= isset(Yii::$app->params['app']['logo']) ? Yii::$app->params['app']['logo'] : Yii::$app->params['app']['defaultImage'] ?> />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script>
        var baseUrl = "<?= Yii::$app->urlManager->baseUrl ?>";
    </script>
    <?php $this->head() ?>
    <?= $this->render('colorschema') ?>

</head>

<body class="fixed-left">
    <?php $this->beginBody() ?>

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <div id="wrapper">
        <?= $this->render('left') ?>
        <div class="content-page">
            <div class="content">
                <?= $this->render('header') ?>
                <?= $this->render(
                    'content.php',
                    [
                        'content' => $content,
                    ]
                ) ?>
            </div>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>