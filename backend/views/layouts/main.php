<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;
use backend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Favicons -->
    <link href="<?=Url::to('@web/img/favicon.png')?>" rel="icon">
    <link href="<?=Url::to('@web/img/apple-touch-icon.png')?>" rel="apple-touch-icon">


    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!--
<div class="wrap">
-->
<?=$this->render('header')?>
<!--
<div class="container">
-->
<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
<?= $content ?>
<!--
</div>
-->
<!--
</div>
-->
<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<?php // echo $this->render('footer')?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
