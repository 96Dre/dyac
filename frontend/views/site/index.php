<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
$this->title = 'DYAC';
?>
<?= Yii::$app->session->getFlash('msg') ?>
<?php if (Yii::$app->session->hasFlash('success')) { ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>Enhorabuena!</h4>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php } else { ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>Error!</h4>
        <?= Yii::$app->session->getFlash('error') ?>
    </div>
<?php } ?>
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-cntent-center align-items-center">
    <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">

        <!--        *************  Busqueda avanzada  ****************-->
        <?php
        $this->registerJs("
            if(document.getElementById('checkboxAvanzada').checked) {            
               $('#formularios_busqueda_avanzados').show();
               $('#busquenormal').hide();
             } else {            
                 $('#formularios_busqueda_avanzados').hide();
                 $('#busquenormal').show();
                };

        $('#checkboxAvanzada').change(function () {    
        
            if(document.getElementById('checkboxAvanzada').checked) {            
               $('#formularios_busqueda_avanzados').show();
               $('#busquenormal').hide();
             } else {            
                 $('#formularios_busqueda_avanzados').hide();
                 $('#busquenormal').show();
                };
                
        });
        ");
        ?>
        <!-- Slide 1 -->
        <div class="carousel-item active">
            <div id="busquenormal" class="">
                <?php
                $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => false,
                ]);
                ?>
                <div class="row col-sm-12 col-md-12">
                    <div class="col-sm-2 col-md-2">
                    </div>
                    <div class="col-sm-8 col-md-8">
                        <?= $form->field($model_coleccion, 'col_titulo')->textInput(['maxlength' => true, 'placeholder' => 'Ingresar colección, investigador, palabras claves'])->label('' .
                            '') ?>
                    </div>
                    <div class="col-sm-2 col-md-2">
                        <center>
                            <div class="">
                                <br>
                                <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
                            </div>
                        </center>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-sm-12">
                <div class="form-check text-center">
                    <input class="form-check-input" type="checkbox" id="checkboxAvanzada" value="" aria-label="...">
                    <label class="text-light" for="flexRadioDefault2">
                        <center>Búsqueda avanzada</center>
                    </label>
                </div>
            </div>
            <div class="row col-sm-12 col-md-12">
                <div class="col-sm-1 col-md-2">
                </div>
                <div class="col-sm-10 col-md-10">
                    <div id="formularios_busqueda_avanzados">
                        <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>
                        <div class="row col-sm-12 col-md-12">
                            <div class="col-sm-10 col-md-10">
                                <div class="text-justify text-light">

                                    <?= $form->field($model_coleccion, 'col_titulo')->textInput(['maxlength' => true, 'placeholder' => 'Ingresar colección, investigador, palabras claves'])->label('') ?>

                                    <?=
                                    $form->field($model_coleccion, 'col_descripcion')->checkBox(['label' => 'Colecciones', 'data-size' => 'small', 'class' => 'bs_switch'
                                        , 'style' => 'margin-bottom:4px;'])
                                    ?>
                                    <?=
                                    $form->field($model_coleccion, 'col_fuente')->checkBox(['label' => 'Investigadores', 'data-size' => 'small', 'class' => 'bs_switch'
                                        , 'style' => 'margin-bottom:4px;'])
                                    ?>
                                    <?=
                                    $form->field($model_coleccion, 'col_estadocol')->checkBox(['label' => 'Disciplinas', 'data-size' => 'small', 'class' => 'bs_switch'
                                        , 'style' => 'margin-bottom:4px;'])
                                    ?>
                                    <?=
                                    $form->field($model_coleccion, 'col_estado')->checkBox(['label' => 'Palabras claves', 'data-size' => 'small', 'class' => 'bs_switch'
                                        , 'style' => 'margin-bottom:4px;'])
                                    ?>
                                </div>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <center>
                                    <div class="">
                                        <br>
                                        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
                                    </div>
                                </center>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- End Hero -->
<main id="main">

    <div class="col-lg-12 entries">
        <section class="service-details">
            <div class="container">
                <div class="section-title">
                    <h2>Últimas colecciones</h2>
                </div>

                <div class="row">

                    <?php if (count($colecciones) != 0) { ?>
                        <?php foreach ($colecciones as $item) { ?>
                            <div class="col-md-3 d-flex align-items-stretch" data-aos="fade-up">
                                <div class="card">
                                    <div class="card-img text-center">
                                        <img src="<?= Url::to(Url::base() . '/../../backend/web/img/coleccion/' . $item->col_portada) ?>"
                                             height="150" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title"><a
                                                    href="<?= Url::to(['/site/coleccionview', 'id' => $item->col_id]) ?>"><?= $item->col_titulo ?></a>
                                        </h5>
                                        <p class="card-text"><?= substr($item->col_descripcion, 0, 30) . '...' ?> </p>
                                        <div class="read-more"><a
                                                    href="<?= Url::to(['/site/coleccionview', 'id' => $item->col_id]) ?>"><i
                                                        class="icofont-arrow-right"></i> Ver más</a></div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <h4><p> No hay colecciones disponibles.</p></h4>
                    <?php } ?>
                </div>
            </div>
        </section>


    </div><!-- End blog entries list -->

    <!-- ======= Features Section ======= -->
    <section class="features">
        <div class="container" style="text-align: justify">

            <div class="section-title">
                <h2></h2>
            </div>

            <div class="row" data-aos="fade-up" >
                <div class="col-md-5">
                    <!--<img src="<?php // Url::to('@web/img/features-1.svg')                                 ?>" class="img-fluid" alt="">-->
                    -<img src="<?= Url::to(Url::base() . '/img/features-1.svg') ?>" class="img-fluid" alt="">
                </div>
                <div class="col-md-7 pt-4">
                    <h3>Colecciones</h3>
                    <p class="font-italic">
                        En las colecciones, se visualizán los recursos archivados por el investigador, que ha decidido
                        dejarlos en la aplicación de Documentación y Archivo Científico, DYAC de la Universidad del
                        Azuay. La colección tiene el nombre del investigador, así como el título de la investigación, la
                        disciplina y los recursos (audio, video, documentos, entre otros). El metadato es información
                        detallada sobre la colección: tópico, año de registro, tiempo de grabación, si fuera audio o
                        video, lengua en la que se hace el registro, entre otros datos especificos.
                    </p>
                    <!-- BOTON PARA COLECCIONES -->
                    <a href="<?= Url::to(Url::base() . '/index.php/site/colecciones') ?>"
                       class="btn-get-started animated fadeInUp">
                        <i class="icofont-arrow-right"></i> Ver más</a>
                </div>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-md-5 order-1 order-md-2">
                    <img src="<?= Url::to('@web/img/features-2.svg') ?>" class="img-fluid" alt="">
                </div>
                <div class="col-md-7 pt-5 order-2 order-md-1">
                    <h3>Tipos de recursos que conforman una colección</h3>
                    <p class="font-italic">
                        Los recursos compartidos pueden ser de diferente tipo: audio,
                        video, documentos, imágenes, etc.
                    </p>
                    <a href="<?= Url::to(Url::base() . '/index.php/site/colecciones') ?>"
                       class="btn-get-started animated fadeInUp"><i
                                class="icofont-arrow-right"></i> Ver más
                    </a>
                </div>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-md-5">
                    <img src="<?= Url::to('@web/img/features-3.svg') ?>" class="img-fluid" alt="">
                </div>
                <div class="col-md-7 pt-5">
                    <h3>Políticas de uso de los recursos</h3>
                    <p class="font-italic"> Los recursos depositados y archivados en DYAC se visualizan por parte de los
                        usuarios que se hayan registrado en esta aplicación. Sí bien es cierto, se ha
                        considerado el principio de la libre disposición de la información, no es menos cierto que cada
                        donante será quien decida la posibilidad de intercambiar o no dichos recursos. En ese caso, si
                        el usuario quisiera emplear los recursos producidos por los investigadores donantes del DYAC
                        deberán: </p>
                    <ul>
                        <li><i class="icofont-check"></i>Contactarse directamente con el investigador dueño de la
                            colección
                        </li>
                        <li><i class="icofont-check"></i>Informarle para qué y con qué fines desea utilizar los recursos
                        </li>
                        <li><i class="icofont-check"></i>Aceptar y respetar los derechos del autor y citarlo cuando
                            emplee dichos recursos
                        </li>
                    </ul>
                    <p class="font-italic"> En el caso de que el autor decidiera no entregar los recursos solicitados
                        por parte de los
                        usuarios, deberá notificar al usuario y a la Universidad del Azuay las razones por las cuales ha
                        tomado esa decisión.</p>
                </div>
            </div>

            <div class="row" data-aos="fade-up">
                <div class="col-md-5 order-1 order-md-2">
                    <img src="<?= Url::to('@web/img/features-4.svg') ?>" class="img-fluid" alt="">
                </div>
                <div class="col-md-7 pt-5 order-2 order-md-1">
                    <h3>Nivel de acceso</h3>
                    <p class="font-italic">
                        El nivel de acceso asignado para cada recurso:

                    </p>
                    <ul>
                        <li><i class="icofont-check"></i>Abierto: los metadatos están disponibles a los usuarios y
                            pueden consultarlos en la aplicación
                            DYAC.
                        </li>
                        <li><i class="icofont-check"></i>Restringido: El uso y el intercambio de recursos quedan a
                            criterio del investigador para
                            conceder el acceso; por lo tanto, la comunicación para solicitar acceso a los recursos es
                            directamente entre el dueño de la colección y el usuario solicitante.
                        </li>

                    </ul>
                </div>
            </div>

        </div>
    </section><!-- End Features Section -->

</main><!-- End #main -->