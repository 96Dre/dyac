<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);

/*
  use yii\bootstrap\Nav;
  use yii\bootstrap\NavBar;

  NavBar::begin([
  'brandLabel' => Yii::$app->name,
  'brandUrl' => Yii::$app->homeUrl,
  'options' => [
  'class' => 'navbar-inverse navbar-fixed-top',
  ],
  ]);
  echo Nav::widget([
  'options' => ['class' => 'navbar-nav navbar-right'],
  'items' => [
  ['label' => 'Home', 'url' => ['/site/index']],
  ['label' => 'About', 'url' => ['/site/about']],
  ['label' => 'Contact', 'url' => ['/site/contact']],
  Yii::$app->user->isGuest ? (
  ['label' => 'Login', 'url' => ['/site/login']]
  ) : (
  '<li>'
  . Html::beginForm(['/site/logout'], 'post')
  . Html::submitButton(
  'Logout (' . Yii::$app->user->identity->username . ')',
  ['class' => 'btn btn-link logout']
  )
  . Html::endForm()
  . '</li>'
  )
  ],
  ]);
  NavBar::end();

 */
?>

<!-- ======= Header ======= <header id="header" class="fixed-top header-transparent"> Menú transparente-->
<header id="header" class="fixed-top">
    <div class="container">
        <div class="logo float-left">
            <!--<h1 class="text-light"><a href="<?= Url::base() ?>"><span>DYAC</span></a></h1>-->
            <!-- Uncomment below if you prefer to use an image logo -->
            <a href="<?= Url::to(['/']) ?>"><img src="<?= Url::base() ?>/img/iconos/logo.png" alt="" class="img-fluid"></a>
        </div>
        <nav class="nav-menu float-right d-none d-lg-block">
            <ul>

                <li><a href="<?= Url::base() ?>">Inicio</a></li>
                <li><a href="<?= Url::to(['/site/about']) ?>">Nosotros</a></li>
                <li><a href="<?= Url::to(['/site/colecciones']) ?>">Colecciones</a></li>
                <li><a href="<?= Url::to(['/site/investigador']) ?>">Investigadores</a></li>                
                <li><a href="<?= Url::to(['/site/contact']) ?>">Contacto</a></li>
                <li><a href="<?= Url::to(['/pregunta-frecuente']) ?>">Preguntas frecuentes</a></li>
                <?php if (Yii::$app->user->isGuest) { ?>

                    <li class="drop-down"><a href="">Mi cuenta</a>
                        <ul>
                            <li><a href="<?= Url::to(['/site/login']) ?>">Iniciar sesión</a></li>
                            <li><a href="<?= Url::to(['/site/signup']) ?>">Registrarse</a></li>
                        </ul>
                    </li>
                    <?php
                } else {
                    ?>
                    <li class="drop-down"><a href=""><?php echo Yii::$app->user->identity->use_nombre . ' ' . Yii::$app->user->identity->use_apellido ?></a>
                        <ul>
                            <li><a href="<?= Url::to(['/user']) ?>">Mi perfil</a></li>
                            <?php if (Yii::$app->user->identity->rol_id == 2) { ?> <!-- USUARIO INVESTIGADOR -->
                                <li><a href="<?= Url::to(['/coleccion']) ?>">Mis colecciones</a></li>
                            <?php } ?>
                            <li><a href="<?= Url::to(['/user/cambiarclave']) ?>">Cambiar clave</a></li>

                            <li>
                                <a>
                                    <?= Html::beginForm(['/site/logout']) ?>
                                    <?= html::submitButton('Cerrar Sesión', ['class' => 'btn btn-light']) ?>
                                    <?= html::endForm() ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>

            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->


