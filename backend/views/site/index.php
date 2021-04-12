<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Url;
use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

$this->title = 'Administrador DYAC';

?>

<main id="main">

    <!-- ======= Contact Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

        </div>
    </section><!-- End Contact Section -->


    <!-- ======= Services Section ======= -->
    <section class="services">
        <div class="container">
            <div class="row">

                <!-- <section class="pricing section-bg" data-aos="fade-up"> -->
                <section class="pricing"  >
                    <div class="container">

                        <?php foreach ($menu as $item){ ?>
                                <div class="col-md-12 col-lg-12 align-items-center" >
                                    <div class="section-title"  >
                                        <h2><?= $item->men_nombre ?></h2>
                                    </div>
                                </div>

                                <?php foreach ($submenu as $subitem){
                                    if($subitem->men_idPadre == $item->men_id){?>
                                        <div class="col-md-6 col-lg-3 d-flex align-items-stretch" >
                                            <div class=<?= '"icon-box icon-box-' . $subitem->men_color .'"'?></div>
                                                <div class="icon"><a href="<?=Url::to([$subitem->men_url])?>"><i class=<?= '"'. $subitem->men_icono .'"'?>></i></a></div>
                                                <h4 class="title"><a href="<?=Url::to([$subitem->men_url])?>"><?= $subitem->men_nombre ?></a></h4>
                                                <p class="description"><?= $subitem->men_descripción?></p>
                                                <?php if($subitem->men_url == '/user'){ ?>
                                                    <?php if($solicitudes > 0){ ?>
                                                        <p class="description text-danger">Tiene <?= $solicitudes ?> solicitudes pendientes. </p>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if($subitem->men_url == '/coleccion'){ ?>
                                                    <?php if($solicitudesCol > 0){ ?>
                                                        <!--<a href="<?php //echo Url::to([$subitem->men_url])?>/pendientes" title="Ver colecciones pendientes">-->
                                                        <a href="<?= Url::to([$subitem->men_url])?>" title="Ver colecciones">
                                                            <p class="description text-danger">Tiene <?= $solicitudesCol ?> solicitudes pendientes. </p>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if($subitem->men_url == '/archivo'){ ?>
                                                    <?php if($solicitudesArc > 0){ ?>
                                                        <!--<a href="<?php //echo Url::to([$subitem->men_url])?>/pendientes" title="Ver archivos pendientes">-->
                                                            <a href="<?= Url::to([$subitem->men_url])?>" title="Ver archivos">
                                                        <p class="description text-danger">Tiene <?= $solicitudesArc ?> solicitudes pendientes. </p>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                <?php }
                                    } ?>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>
    </section><!-- End Services Section -->
    
    
    
    
    
    
    
    <!-- ======= Services Section ======= -->
    <section class="services">
        <div class="container">
            <div class="row">

                <!-- <section class="pricing section-bg" data-aos="fade-up"> -->
                <section class="pricing"  >
                    <div class="container">

                        <?php foreach ($menu_final as $item){ ?>
                                <div class="col-md-12 col-lg-12 align-items-center" >
                                    <div class="section-title"  >
                                        <h2><?= $item->men_nombre ?></h2>
                                    </div>
                                </div>

                                <?php foreach ($submenu as $subitem){
                                    if($subitem->men_idPadre == $item->men_id){?>
                                        <div class="col-md-6 col-lg-3 d-flex align-items-stretch" >
                                            <div class=<?= '"icon-box icon-box-' . $subitem->men_color .'"'?></div>
                                                <div class="icon"><a href="<?=Url::to([$subitem->men_url])?>"><i class=<?= '"'. $subitem->men_icono .'"'?>></i></a></div>
                                                <h4 class="title"><a href="<?=Url::to([$subitem->men_url])?>"><?= $subitem->men_nombre ?></a></h4>
                                                <p class="description"><?= $subitem->men_descripción?></p>
                                                <?php if($subitem->men_url == '/user'){ ?>
                                                    <?php if($solicitudes > 0){ ?>
                                                        <p class="description text-danger">Tiene <?= $solicitudes ?> solicitudes pendientes. </p>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if($subitem->men_url == '/coleccion'){ ?>
                                                    <?php if($solicitudesCol > 0){ ?>
                                                        <!--<a href="<?php //echo Url::to([$subitem->men_url])?>/pendientes" title="Ver colecciones pendientes">-->
                                                        <a href="<?= Url::to([$subitem->men_url])?>" title="Ver colecciones">
                                                            <p class="description text-danger">Tiene <?= $solicitudesCol ?> solicitudes pendientes. </p>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                                <?php if($subitem->men_url == '/archivo'){ ?>
                                                    <?php if($solicitudesArc > 0){ ?>
                                                        <!--<a href="<?php // Url::to([$subitem->men_url])?>/pendientes" title="Ver archivos pendientes">-->
                                                        <a href="<?= Url::to([$subitem->men_url])?>" title="Ver archivos">
                                                        <p class="description text-danger">Tiene <?= $solicitudesArc ?> solicitudes pendientes. </p>
                                                        </a>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                <?php }
                                    } ?>
                        <?php } ?>
                    </div>
                </section>
            </div>
        </div>
    </section><!-- End Services Section -->
    
    
    
    
    
    

</main><!-- End #main -->
