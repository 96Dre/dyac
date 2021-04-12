<?php

use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

?>


<!-- ======= Header ======= <header id="header" class="fixed-top header-transparent"> Menú transparente-->
<header id="header" class="fixed-top">
    <div class="container">
        <div class="logo float-left">
            <!--<h1 class="text-light"><a href="<?php //Url::base()?>"><span>DYAC</span></a></h1>-->
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html"><img src="../web/img/logo.png" alt="" class="img-fluid"></a>-->
            <a href="<?= Url::to(['/']) ?>"><img src="<?= Url::base() ?>/img/iconos/logo.png" alt="" class="img-fluid"></a>
        </div>
        <nav class="nav-menu float-right d-none d-lg-block">
            <ul>

                <?php if(Yii::$app->user->isGuest){ ?>
                    <li class="drop-down"><a href="">Mi cuenta</a>
                        <ul>
                            <li><a href="<?=Url::to(['/site/login'])?>">Iniciar resión</a></li>
                        </ul>
                    </li>
                    <?php
                }
                else { ?>
                    <li class="drop-down"><a href=""><?php echo Yii::$app->user->identity->use_nombre . ' ' . Yii::$app->user->identity->use_apellido ?></a>
                        <ul>

                            <li>
                                <a>
                                    <?= Html::beginForm(['/site/logout'])?>
                                    <?= html::submitButton('Cerrar Sesión',['class'=>'btn btn-light'])?>
                                    <?= html::endForm()?>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->


