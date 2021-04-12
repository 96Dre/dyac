<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);

$this->title = 'Nosotros';
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
    <!-- ======= Our Skills Section ======= -->
    <section class="skills" data-aos="fade-up">
        <div class="container">

            <div class="section-title">
                <h2>Reseña</h2>
            </div>

            <div class="row">
                <p>El archivo digital Documentación y Archivo Científico, DYAC de la Universidad del Azuay, es una
                    aplicación web destinada a preservar documentos y datos primarios de la investigación
                    lingüística, antropológica, arqueológica, humanística, en otras.
                    Es un archivo digital que contiene grabaciones, textos y otros materiales multimedia,
                    que están a disposición de usuarias con fines de estudio. La
                    Su misión es preservar estos materiales y ponerlos a disposición de
                    investigadores y otros amigos de estas lenguas Entre sus principales objetivos está:</p><br>
                <p>Contribuir a la documentación, preservación y difusión del patrimonio lingüístico y cultural del
                    país.</p><br>
                <p>Brindar acceso a los recursos para su utilización e intercambio con fines científicos y educativos a
                    través de esta aplicación web, que permitirá el acceso a corpus de diversas disciplinas.</p><br>
                <p> En 2018, la Universidad del Azuay decidió incorporarse al Convenio para la Cooperación Tecnológica
                    entre
                    CONICET Argentina y el Instituto de Investigaciones de la Amazonia Peruana, la Universidad de Chile,
                    Facultad de Filosofía y Humanidades, la Universidad Nacional de Formosa, el Centro de Estudios
                    Antropológicos de la Universidad Católica, la Universidad Nacional de San Juan y la Pontificia
                    Universidad Católica del Perú.</p><br>
                <p>Legalmente la Red entró en vigencia en septiembre del 2020 y a partir de
                    esa fecha, la Universidad del Azuay, pone a disposición del público local, nacional e internacional
                    su
                    aplicación web Documentación y archivo científico, DYAC. Se espera ir ampliando poco a poco el
                    contenido
                    digital del archivo a través de la creación de nuevas colecciones producidas por investigadores
                    locales
                    y regionales del país.</p><br>
                <p>La plataforma posee un acceso abierto que permite la difusión del contenido y ayuda al intercambio de
                    materiales producidos por los investigadores. Estos recursos están a disposición de los usuarios
                    solamente con fines de estudio e investigación, respetando los derechos del autor.</p><br>
                <p>El uso de los
                    materiales por parte de los usuarios con fines investigativos deberá considerar el reconocimientos
                    de
                    derechos de autoría del dueño de la colección. De este modo, el usuario que decidiera usar algún
                    tipo de
                    material cargado en el DYAC, deberá conectarse con el dueño de la colección para solicitarle,
                    permiso
                    para el uso de sus materiales.</p><br>

            </div>
        </div>
    </section>
    <!-- ======= About Section ======= -->
    <section class="about" data-aos="fade-up">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <img src="<?= Url::to('@web/img/about.jpg') ?>" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>
                    <p>
                        La creación de esta aplicación web nació como un proyecto de investigación patrocinado por el
                        Vicerrectorado de investigaciones de la Universidad del Azuay, a cargo del Ingeniero Jacinto
                        Guillén, partió del proyecto investigativo Lingüística de la Documentación a cargo de Priscila
                        Verdugo Cárdenas y Jaqueline Verdugo, quienes han estado documentado eventos de habla en tres
                        provincias al sur del Ecuador. Además, el DYAC fue diseñado y desarrollado por Catalina
                        Astudillo y Santiago Cedillo.
                    </p>
                    <p class="font-italic">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore
                        magna aliqua.
                    </p>
                    <ul>
                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                            consequat.
                        </li>
                        <li><i class="icofont-check-circled"></i> Duis aute irure dolor in reprehenderit in voluptate
                            velit.
                        </li>
                        <li><i class="icofont-check-circled"></i> Ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda
                            mastiro dolore eu fugiat nulla pariatur.
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Facts Section ======= -->
    <section class="facts section-bg" data-aos="fade-up">
        <div class="container">

            <div class="row counters">

                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up">232</span>
                    <p>Clients</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up">521</span>
                    <p>Projects</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up">1,463</span>
                    <p>Hours Of Support</p>
                </div>

                <div class="col-lg-3 col-6 text-center">
                    <span data-toggle="counter-up">15</span>
                    <p>Hard Workers</p>
                </div>

            </div>

        </div>
    </section><!-- End Facts Section -->

    <!-- ======= Our Skills Section ======= -->
    <section class="skills" data-aos="fade-up">
        <div class="container">

            <div class="section-title">
                <h2>Our Skills</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                    fugiat sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="skills-content">

                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                         aria-valuemax="100">
                        <span class="skill">HTML <i class="val">100%</i></span>
                    </div>
                </div>

                <div class="progress">
                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                         aria-valuemax="100">
                        <span class="skill">CSS <i class="val">90%</i></span>
                    </div>
                </div>

                <div class="progress">
                    <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                         aria-valuemax="100">
                        <span class="skill">JavaScript <i class="val">75%</i></span>
                    </div>
                </div>

                <div class="progress">
                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="55" aria-valuemin="0"
                         aria-valuemax="100">
                        <span class="skill">Photoshop <i class="val">55%</i></span>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Our Skills Section -->

    <!-- ======= Tetstimonials Section ======= -->
    <section class="testimonials" data-aos="fade-up">
        <div class="container">

            <div class="section-title">
                <h2>Tetstimonials</h2>
                <p>La creación de esta aplicación web nació como un proyecto de investigación patrocinado por el
                    Vicerrectorado de investigaciones de la Universidad del Azuay, a cargo del Ingeniero Jacinto
                    Guillén, partió del proyecto investigativo Lingüística de la Documentación a cargo de Priscila
                    Verdugo Cárdenas y Jaqueline Verdugo, quienes han estado documentado eventos de habla en tres
                    provincias al sur del Ecuador. Además, el DYAC fue diseñado y desarrollado por Catalina Astudillo y
                    Santiago Cedillo.</p>

            </div>

            <div class="owl-carousel testimonials-carousel">

                <div class="testimonial-item">
                    <img src="<?= Url::to('@web/img/testimonials/testimonials-1.jpg') ?>" class="testimonial-img"
                         alt="">
                    <h3>Priscila Verdugo</h3>
                    <h4>Directora del Proyecto, Lic. </h4>
                    <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
                        Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                </div>

                <div class="testimonial-item">
                    <img src="<?= Url::to('@web/img/testimonials/testimonials-2.jpg') ?>" class="testimonial-img"
                         alt="">
                    <h3>Catalina Astudillo</h3>
                    <h4>Ing. de Sistemas, Especialista en docencia universitaria, Mgst. en diseño multimedia</h4>
                    <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram
                        malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                </div>

                <div class="testimonial-item">
                    <img src="<?= Url::to('@web/img/testimonials/testimonials-3.jpg') ?>" class="testimonial-img"
                         alt="">
                    <h3>Jackie Verdugo</h3>
                    <h4>Lic. </h4>
                    <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis
                        minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                </div>

                <div class="testimonial-item">
                    <img src="<?= Url::to('@web/img/testimonials/testimonials-4.jpg') ?>" class="testimonial-img"
                         alt="">
                    <h3>Santiago Cedillo</h3>
                    <h4>Egresado</h4>
                    <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim
                        velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum
                        veniam.
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                </div>
                <!--
                <div class="testimonial-item">
                    <img src="<?= Url::to('@web/img/testimonials/testimonials-5.jpg') ?>" class="testimonial-img"
                         alt="">
                    <h3>John Larson</h3>
                    <h4>Entrepreneur</h4>
                    <p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim
                        culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum
                        quid.
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                </div>
-->
            </div>

        </div>
    </section><!-- End Ttstimonials Section -->

</main><!-- End #main -->
