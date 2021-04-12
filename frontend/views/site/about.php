<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);
$this->title = 'Nosotros';
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
        <div class="container" style="text-align: justify">
            <div class="section-title">
                <h2>Reseña</h2>
            </div>
            <div class="row" >
                <p>El archivo digital, Documentación y Archivo Científico (DYAC) de la Universidad del Azuay, es una
                    aplicación web destinada a preservar documentos y datos primarios de la investigación
                    lingüística, antropológica, arqueológica, humanística, en otras.
                    Es un archivo digital que contiene grabaciones, textos y otros materiales multimedia,
                    que están a disposición de usuarias con fines de estudio. </p><br>
                <p>Su misión es preservar estos materiales y ponerlos a disposición de
                    investigadores y usuarios especializados en las áreas mencionadas anteriormente.</p><br>
            </div>
            <br>
            <div class="section-title">
                <h2>Objetivos</h2>
            </div>
            <div class="row">
                <ul>
                    <li>Contribuir al incremento de la documentación, preservación y difusión del
                        patrimonio lingüístico y cultural del
                        país.
                    </li>
                    <li>Brindar acceso a los recursos para su utilización e intercambio con
                        fines científicos y educativos.
                    </li>
                    <li>Difundir los recursos primarios producidos en investigaciones
                        vinculadas a la Lingüística, Antropología, Historia, Ciencias Sociales, entre otras.
                    </li>
                    <li>Intercambiar recursos entre los investigadores y los usuarios de la
                        aplicación, siempre y cuando sean con propósitos académicos y sin fines de lucro; con el debido
                        reconocimiento de los derechos de autor de los recursos. En el caso de que el usuario quiera
                        emplear cualquier información que obtenga de esta aplicación, deberá citarlo del modo en el que
                        se indica en el DYAC.
                    </li>
                </ul>
            </div>
            <br>
            <div class="section-title">
                <h2>Antecedentes</h2>
            </div>
            <div class="row">
                <p>En 2018, la Universidad del Azuay decidió incorporarse al Convenio para la Cooperación Tecnológica
                    entre CONICET Argentina y el Instituto de Investigaciones de la Amazonia Peruana, la Universidad de
                    Chile, Facultad de Filosofía y Humanidades, la Universidad Nacional de Formosa, el Centro de
                    Estudios Antropológicos de la Universidad Católica, la Universidad Nacional de San Juan y la
                    Pontificia Universidad Católica del Perú. Legalmente la Red entró en vigencia en septiembre del 2020
                    y a partir de esa fecha, la Universidad del Azuay pone a disposición del público local, nacional e
                    internacional su aplicación web Documentación y archivo científico, DYAC. Se espera ir ampliando
                    poco a poco el contenido digital del archivo a través de la creación de nuevas colecciones
                    producidas por investigadores locales y regionales del país.</p><br>
            </div>
        </div>
    </section>
    <!-- ======= About Section ======= -->
    <section class="about" data-aos="fade-up">
        <div class="container" style="text-align: justify">

            <div class="row">
                <div class="col-lg-6">
                    <img src="<?= Url::to('@web/img/about.jpg') ?>" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0">
                    <h3>Equipo de investigación.</h3>
                    <p>
                        El equipo investigativo de la aplicación DYAC de la Universidad del Azuay está conformado por
                        profesionales con diferentes experticias. Se ha intentado consolidar un equipo
                        con conocimientos en: documentación y creación de archivos científicos, lengua y literatura,
                        dominio en la creación de aplicaciones, sitios web y plataformas. Además de contar con la
                        colaboración de estudiantes de pre grado de la Universidad de las diferentes
                        facultades.
                    </p>
                    <p>
                        Nació como un proyecto de investigación patrocinado por el
                        Vicerrectorado de investigaciones de la Universidad, a cargo del Ingeniero Jacinto
                        Guillén, cuenta con la colaboración de Priscila
                        Verdugo Cárdenas y Jaqueline Verdugo, quienes han estado documentado eventos de habla en tres
                        provincias al sur del Ecuador. Además, el desarrollo y construcción de la aplicación se dio con
                        la ayuda de Catalina Astudillo y Santiago Cedillo.
                    </p>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Tetstimonials Section ======= -->
    <section class="testimonials" data-aos="fade-up">
        <div class="container">

            <div class="section-title" >
                <h2>Investigadores</h2>
                <p style="text-align: justify">La creación de esta aplicación web nació como un proyecto de investigación patrocinado por el
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
                    <h4>Directora del Proyecto, Mgst. en Docencia Universitaria</h4>
                    <p><a href="https://irene.uazuay.edu.ec/scholar/profile-researchers/fabiola-priscila-verdugo" target="_blank">Ver curriculum</a></p>
                </div>

                <div class="testimonial-item">
                    <img src="<?= Url::to('@web/img/testimonials/testimonials-2-act.jpg') ?>" class="testimonial-img"
                         alt="">
                    <h3>Catalina Astudillo</h3>
                    <h4>Ing. de Sistemas, Especialista en Docencia Universitaria, Mgst. en Diseño Multimedia</h4>
                    <p><a href="https://irene.uazuay.edu.ec/scholar/profile-researchers/catalina-veronica-astudillo" target="_blank">Ver curriculum</a></p>
                </div>

                <div class="testimonial-item">
                    <img src="<?= Url::to('@web/img/testimonials/testimonials-3-act.jpg') ?>" class="testimonial-img"
                         alt="">
                    <h3>Jackie Verdugo</h3>
                    <h4>Lic. </h4>
                    <p><a href="" target="_blank">Ver curriculum</a></p>
                </div>

                <div class="testimonial-item">
                    <img src="<?= Url::to('@web/img/testimonials/testimonials-4.jpg') ?>" class="testimonial-img"
                         alt="">
                    <h3>Santiago Cedillo</h3>
                    <h4>Egresado</h4>
                    <!--<p>
                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                        Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim
                        velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum
                        veniam.
                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>-->
                </div>
            </div>
        </div>
    </section><!-- End testimonials Section -->

</main><!-- End #main -->
