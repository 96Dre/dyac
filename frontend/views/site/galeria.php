<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
AppAsset::register($this);

$this->title = 'Galeria';
//$this->params['breadcrumbs'][] = $this->title;

/* HTML
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>
*/

?>


<main id="main">

    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>

            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Portfolio Section ======= -->
    <section class="portfolio">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <ul id="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-app">App</li>
                        <li data-filter=".filter-card">Card</li>
                        <li data-filter=".filter-web">Web</li>
                    </ul>
                </div>
            </div>

            <div class="row portfolio-container" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">

                <div class="col-lg-4 col-md-6 filter-app">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-1.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-1.jpg')?>" data-gall="portfolioGallery" class="venobox" title="App 1">App 1</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-1.jpg')?>" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 filter-web">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-2.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-2.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Web 3">Web 3</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-2.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Web 3"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 filter-app">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-3.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-3.jpg')?>" data-gall="portfolioGallery" class="venobox" title="App 2">App 2</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-3.jpg')?>" data-gall="portfolioGallery" class="venobox" title="App 2"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 filter-card">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-4.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-4.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Card 2">Card 2</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-4.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Card 2"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 filter-web">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-5.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-5.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Web 2">Web 2</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-5.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Web 2"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 filter-app">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-6.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-6.jpg')?>" data-gall="portfolioGallery" class="venobox" title="App 3">App 3</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-6.jpg')?>" data-gall="portfolioGallery" class="venobox" title="App 3"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 filter-card">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-7.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-7.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Card 1">Card 1</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-7.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Card 1"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 filter-card">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-8.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-8.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Card 3">Card 3</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-8.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Card 3"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 filter-web">
                    <div class="portfolio-item">
                        <img src="<?=Url::to('@web/img/portfolio/portfolio-9.jpg')?>" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h3><a href="<?=Url::to('@web/img/portfolio/portfolio-9.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Web 1">Web 1</a></h3>
                            <a href="<?=Url::to('@web/img/portfolio/portfolio-9.jpg')?>" data-gall="portfolioGallery" class="venobox" title="Web 1"><i class="icofont-plus"></i></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Portfolio Section -->


</main><!-- End #main -->
