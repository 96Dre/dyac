<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use frontend\assets\AppAsset;
AppAsset::register($this);

$this->title = $name;
?>
<main id="main">
    <!-- ======= Header Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

        </div>
    </section><!-- End Header Section -->
    <!-- ======= Body Section ======= -->
    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <p>
                Estamos trabajando para solucionar el error lo antes posible.
            </p>
            <p>
                Disculpe las molestias.
            </p>

        </div>
    </section>
    <!-- ======= End Body Section ======= -->
</main><!-- End #main -->