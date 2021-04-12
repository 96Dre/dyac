<?php

//use yii;
use frontend\models\detallearchivoatributoex\Detallearchivoatributoex;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use \yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;

AppAsset::register($this);
$this->title = $model->col_titulo;

/* @var $this yii\web\View */
/* @var $model frontend\models\coleccion\Coleccion */
/* @var $disciplina */
/* @var $investigador */
/* @var $datosInv */
/* @var $coleccionpais frontend\models\coleccionpais\Coleccionpais */
/* @var $palabraclave frontend\models\palabraclave\Palabraclave */
/* @var $atrExtra frontend\models\coleccionatributoex\Coleccionatributoex */
/* @var $coleccionpersona */

//$this->title = $model->col_titulo;
\yii\web\YiiAsset::register($this);
?>

<?php
$discList = backend\models\disciplina\Disciplina::find()->select(['dis_id', 'dis_nombre'])->orderBy('dis_nombre')->all();
?>

<main id="main">
    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>
                <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
                <section class="breadcrumbs"> <!-- Buscar -->
                    <!--        *************  Busqueda avanzada  ****************-->

                    <div class="row  rounded col-sm-12">
                        <div id="busquenormal" class="col-sm-7 col-md-7">
                            <?php
                            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                'enableClientValidation' => false,
                                'enableAjaxValidation' => false,
                            ]);
                            ?>
                            <div class="row col-sm-12 col-md-12">
                                <div class="col-sm-9 col-md-9">
                                    <?= $form->field($model_coleccion, 'col_titulo')->textInput(['maxlength' => true, 'placeholder' => 'Ingresar colección, investigador, palabras claves' ])->label(false) ?>
                                </div>
                                <div class="col-sm-2 col-md-2">
                                    <center>
                                        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
                                    </center>
                                </div>

                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>

                        <div class="col-sm-5 col-md-5">
                            <a href="<?= Url::to(['/']) ?>">
                                Busqueda avanzada
                            </a>
                        </div>

                    </div>
                </section> <!-- Fin de buscar -->
                <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
            </div>
        </div>
    </section><!-- End About Us Section -->
    <!-- ======= Blog Section ======= -->
    <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 entries">

                    <article class="entry entry-single">
                        <div class="entry-img">
                            <img src="<?= Url::to(Url::base() . '/../../backend/web/img/coleccion/' . $model->col_portada) ?>"
                                 alt="" width="width:100%" height="" style="width:100%" class="img-fluid">
                        </div>

                        <h1 class="entry-title" style="text-align: center">
                            <a href="#"><?= $model->col_titulo ?></a>
                        </h1>

                        <div class="entry-meta">
                            <ul style="display: flex;  flex-direction: column;  align-items: center;">
                                <li class="d-flex align-items-center"><i class="icofont-user"></i> <a
                                            href="<?= Url::to(['/site/coleccionesinvestigador', 'inv' => $datosInv->inv_id]) ?>"><?= $investigador->use_nombre . ' ' . $investigador->use_apellido . ' | ' ?></a>
                                    <i class="icofont-wall-clock"></i> <a href="">
                                        <time datetime=""><?= $model->col_fechaCreacion ?></time>
                                    </a></li>
                            </ul>
                        </div>

                        <p class="entry-content">
                        <h4>Descripción: </h4>
                        <p class="text-justify"> <?= $model->col_descripcion ?> </p>
                        <table style="width:100%" border="0">
                            <tr>
                                <td style="width:50%">
                                    <h4>Fecha de creación: </h4>
                                    <p> <?= $model->col_fechaPublicacion ?> </p>
                                </td style="width:50%">
                                <td>
                                    <h4>Fuente: </h4>
                                    <p> <?= $model->col_fuente ?> </p>
                                </td>
                            </tr>


                        </table>
                        <!--  Se verifica que exista datos en coleccion-pais -->
                        <?php if ($coleccionpais > 0) { ?>

                            <table style="width:100%" border="0">
                                <tr>
                                    <th style="width:50%"><h4>País: </h4></th>
                                    <th style="width:50%"><h4>Ubicación: </h4></th>
                                </tr>
                                <?php foreach ($coleccionpais as $item) { ?>
                                    <?php $temp = \backend\models\pais\Pais::Find()->select(['pai_nombre'])->Where(['pai_id' => $item->pai_id])->one(); ?>
                                    <tr>
                                        <td><p><?= $temp->pai_nombre ?></p></td>
                                        <td><p><?= $item->cpa_ubicacion ?> </p></td>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } ?>
                        <!--  Se verifica que exista datos en atributos-extra -->
                        <?php if ($atrExtra > 0) { ?>
                            <table style="width:100%" border="0">
                                <?php foreach ($atrExtra as $item) { ?>
                                    <?php $temp = backend\models\atributoextra\Atributoextra::Find()->Where(['aex_id' => $item->aex_id])->one(); ?>
                                    <tr>
                                        <td>
                                            <h4><?= $temp->aex_nombre ?>:</h4>
                                            <p><?= $item->cae_descripcion ?><p>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        <?php } ?>

                        <!--  Se verifica que exista datos en coleccionpersona -->
                        <?php if ($coleccionpersona > 0) { ?>
                            <h4>Colaboradores: </h4>
                            <p>
                                <?php foreach ($coleccionpersona as $item) { ?>
                                    <?php
                                    $temp = \frontend\models\investigador\Investigador::find()
                                        ->select(['usu_id'])
                                        ->where(['inv_id' => $item->inv_id])
                                        ->one();

                                    $tempCol = \frontend\models\user\User::find()
                                        ->select(['use_nombre', 'use_apellido'])
                                        ->where(['id' => $temp])
                                        ->one();
                                    ?>
                                    <?= $tempCol->use_nombre . ' ' . $tempCol->use_apellido . ', ' ?>
                                <?php } ?>
                            </p>
                        <?php } ?>
                        <!--  Se verifica que exista datos en palabras clave -->
                        <?php if ($palabraclave > 0) { ?>
                            <h4>Palabras clave: </h4>
                            <p>
                                <?php foreach ($palabraclave as $item) { ?>
                                    <?= $item->pcl_palabraClave . ', ' ?>
                                <?php } ?>
                            </p>
                            <br>
                        <?php } ?>

                        <!--  Se verifica que exista datos en coleccionpersona -->
                        <section class="portfolio">
                            <div class="container">

                                <?php if ($archivo > 0) { ?>
                                    <div class="section-title">
                                        <h2>Recursos de la colección</h2>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul id="portfolio-flters">
                                                <li data-filter="*" class="filter-active">Todo</li>
                                                <?php foreach ($archivo as $item) { ?>
                                                    <li data-filter=".filter-<?= $item->arc_tipo ?>"><?= $item->arc_tipo ?></li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>

                                    <?php //*** PRICIPAL PARA IMPRIMIR LOS ARCHIVOS ***// ?>

                                    <div class="row portfolio-container" data-aos="fade-up"
                                         data-aos-easing="ease-in-out" data-aos-duration="500">

                                        <?php
                                        $bandera_registrar = 0;
                                        foreach ($archivo as $item) { ?>

                                            <?php if (!Yii::$app->user->isGuest) { ?>
                                                <div class="col-lg-12 col-md-12 filter-<?= $item->arc_tipo ?>">
                                                    <table style="width:100%" border="0">
                                                        <tr>
                                                            <td style="width:50%">
                                                                <?php
                                                                // **************************************
                                                                if ($item->der_id == 1) {
                                                                    // **************************************
                                                                    ?>
                                                                    <?php if ($item->arc_tipo == 'Imagen') { ?>
                                                                        <div class="col-lg-12 col-md-12 filter-<?= $item->arc_tipo ?>"
                                                                             align="center">
                                                                            <div class="portfolio-item" align="center">
                                                                                <img src="<?= Url::to(Url::base() . '/img/archivo/' . $item->arc_archivo) ?>"
                                                                                     style="object-fit: cover" alt=""
                                                                                     width="100%" height="350">
                                                                                <div class="portfolio-info">
                                                                                    <h3>
                                                                                        <a href="<?= Url::to(Url::base() . '/img/archivo/' . $item->arc_archivo) ?>"
                                                                                           data-gall="portfolioGallery"
                                                                                           class="venobox"
                                                                                           title="<?= $item->arc_tipo ?>">Ver</a>
                                                                                    </h3>
                                                                                    <a href="<?= Url::to(Url::base() . '/img/archivo/' . $item->arc_archivo) ?>"
                                                                                       data-gall="portfolioGallery"
                                                                                       class="venobox"
                                                                                       title="<?= $item->arc_tipo ?>"><i
                                                                                                class="icofont-plus"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php } else { ?>
                                                                        <?php if ($item->arc_tipo == 'Video') { ?>
                                                                            <div class="col-lg-12 col-md-12 filter-<?= $item->arc_tipo ?>"
                                                                                 align="center">
                                                                                <div class="col-lg-6 video-box">
                                                                                    <video width="" height="500"
                                                                                           controls>
                                                                                        <source src="<?= Url::to(Url::base() . '/img/archivo/' . $item->arc_archivo) ?>"
                                                                                                type="video/mp4">
                                                                                    </video>
                                                                                </div>

                                                                            </div>

                                                                        <?php } else { ?>
                                                                            <?php if ($item->arc_tipo == 'PDF') { ?>
                                                                                <div class="col-lg-12 col-md-12 filter-<?= $item->arc_tipo ?>"
                                                                                     align="center">
                                                                                    <h4>
                                                                                        <a href="<?= Url::to(Url::base() . '/img/archivo/' . $item->arc_archivo) ?>"
                                                                                           target="_blank">Ver PDF
                                                                                        </a>
                                                                                    </h4>
                                                                                </div>
                                                                            <?php } else { ?>
                                                                                <?php if ($item->arc_tipo == 'Audio') { ?>
                                                                                    <div class="col-lg-12 col-md-12 filter-<?= $item->arc_tipo ?>"
                                                                                         align="center">
                                                                                        <audio controls>
                                                                                            <source src="<?= Url::to(Url::base() . '/img/archivo/' . $item->arc_archivo) ?>"
                                                                                                    type="audio/mp3">
                                                                                        </audio>

                                                                                    </div>
                                                                                <?php } else { ?>
                                                                                    <?php if ($item->arc_tipo == 'Url' || $item->arc_tipo == 'URL') { ?>
                                                                                        <div class="col-lg-12 col-md-12 filter-<?= $item->arc_tipo ?>"
                                                                                             align="center">
                                                                                            <h4>
                                                                                                <a href="<?= Url::to($item->arc_archivo) ?>"
                                                                                                   target="_blank">Ir a
                                                                                                    Url
                                                                                                </a>
                                                                                            </h4>
                                                                                        </div>
                                                                                    <?php } else { ?>
                                                                                        <div class="col-lg-12 col-md-12 filter-<?= $item->arc_tipo ?>"
                                                                                             align="center">
                                                                                            <h4>

                                                                                                <a href="<?= Url::to(Url::base() . '/img/archivo/' . $item->arc_archivo) ?>">Descargar
                                                                                                    archivo
                                                                                                </a>
                                                                                            </h4>
                                                                                        </div>
                                                                                    <?php }
                                                                                }
                                                                            }
                                                                        }
                                                                    } ?>
                                                                <?php } //Fin de archivos abiertos
                                                                else { ?>

                                                                    <div class="tarjeta_ejemplo col-md-12">
                                                                        <form class=""
                                                                              action="mailto:<?= $item->col->inv->usu->email ?>"
                                                                              method="post" name="form1">
                                                                            <div class="card text-justify">
                                                                                <div class="card-header text-center text-primary">
                                                                                    <b>ARCHIVO RESTRINGIDO</b></div>
                                                                                <div class="card-body">
                                                                                    <div class="col-md-12">
                                                                                        <label for="nombre"><b>Nombre: </b></label>
                                                                                        <input id="nombre" name="nombre"
                                                                                               type="text"
                                                                                               class="col-md-8"
                                                                                               value="<?= $item->col->inv->usu->use_apellido . " " . $item->col->inv->usu->use_nombre ?>"/>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <label for="email"><b>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                                                                                        <input id="email" name="nombre"
                                                                                               type="text"
                                                                                               class="col-md-8"
                                                                                               value="<?= $item->col->inv->usu->email ?>"/>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <b>Interes: &nbsp;</b>
                                                                                        <textarea id="opinion"
                                                                                                  name="opinion"
                                                                                                  class="col-md-8"
                                                                                                  rows="3">Estoy interesado en su archivo de tipo <?= $item->arc_tipo ?></textarea>
                                                                                    </div>
                                                                                    <div class="form-field col-md-12">
                                                                                        <center><input name="Submit"
                                                                                                       type="submit"
                                                                                                       class="btn btn-primary"
                                                                                                       value="Contactar por email"/>
                                                                                        </center>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                // **************************************
                                                                ?>
                                                            </td>

                                                            <td style="width:50%">
                                                                <table style="width:100%" border="0"
                                                                       table-layout="fixed">
                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="display:inline">
                                                                                Descripción:</h5>
                                                                            <?= $item->arc_descripcion ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $pais = \backend\models\pais\Pais::Find()->select(['pai_nombre'])->Where(['pai_id' => $item->pai_id])->one(); ?>
                                                                        <td>
                                                                            <h5 style="display:inline">
                                                                                País:</h5>
                                                                            <?= $pais->pai_nombre ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="display:inline">
                                                                                Ubicación:</h5>
                                                                            <?= $item->arc_ubicacion ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $tArchivo = \backend\models\tipoarchivo\Tipoarchivo::Find()->select(['tar_tipo'])->Where(['tar_id' => $item->tar_id])->one(); ?>
                                                                        <td>
                                                                            <h5 style="display:inline">Tipo de
                                                                                archivo:</h5>
                                                                            <?= $tArchivo->tar_tipo ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $genero = \backend\models\genero\Genero::Find()->select(['gen_nombre'])->Where(['gen_id' => $item->gen_id])->one(); ?>
                                                                        <td>
                                                                            <h5 style="display:inline">
                                                                                Género:</h5>
                                                                            <?= $genero->gen_nombre ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $idioma = \backend\models\idioma\Idioma::Find()->select(['idi_nombre'])->Where(['idi_id' => $item->idi_id])->one(); ?>
                                                                        <td>
                                                                            <h5 style="display:inline">
                                                                                Idioma:</h5>
                                                                            <?= $idioma->idi_nombre ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php $derecho = \backend\models\derecho\Derecho::Find()->select(['der_nombre'])->Where(['der_id' => $item->der_id])->one(); ?>
                                                                        <td>
                                                                            <h5 style="display:inline">Derechos
                                                                                de autor:</h5>
                                                                            <?= $derecho->der_nombre ?>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <h5 style="display:inline">
                                                                                Cita:</h5>
                                                                            <?= $item->arc_cita ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>

                                                                <?php
                                                                if (Detallearchivoatributoex::find()->where(['arc_id' => $item->arc_id])->count() > 0) {
                                                                    //Se crea un array para el modelo de coleccion-pais
                                                                    $detalleAE = Detallearchivoatributoex::find()->where(['arc_id' => $item->arc_id])->all();
                                                                } else {
                                                                    //Se crea un array para el modelo de coleccion-pais
                                                                    $detalleAE = null;
                                                                }
                                                                ?>
                                                                <?php if ($detalleAE != null) { ?>
                                                                    <table style="width:100%" border="0"
                                                                           table-layout="fixed">
                                                                        <?php foreach ($detalleAE as $itemAE) { ?>
                                                                            <tr>
                                                                                <?php $atributoExtra = \backend\models\atributoextra\Atributoextra::find()->select(['aex_nombre'])->Where(['aex_id' => $itemAE->aex_id])->one(); ?>
                                                                                <td>
                                                                                    <h5 style="display:inline">
                                                                                        <?= $atributoExtra->aex_nombre . ': ' ?></h5>
                                                                                    <?= $itemAE->dae_descripcion ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </table>
                                                                <?php } ?>
                                                            </td>
                                                        </tr>
                                                        <br>
                                                    </table>
                                                </div>

                                                <?php

                                            } else {
                                                if ($bandera_registrar == 0) { // Una sola vez le muestra el registrar, iniciar sesión etc
                                                    ?>
                                                    <p width="30%" text-align="center">
                                                        Para ver este archivo debe <a href="login">iniciar
                                                            sesión</a>
                                                        o <a href="signup"> registrarse</a>
                                                    </p>
                                                    <?php
                                                    $bandera_registrar = 1;
                                                } // Fin una sola vez le muestra el registrar, iniciar sesión etc
                                            }
                                            ?>


                                        <?php } ?> <!-- FINALIZA BUCLE DE ARCHIVOS -->


                                    </div>
                                    <br>
                                <?php } ?>

                            </div>
                        </section>



                <div class="entry-footer clearfix">
                    <div class="float-left">
                        <!-- <i class="icofont-folder"></i> icono carpeta -->
                        <i class="icofont-tags"></i>
                        <ul class="tags">
                            <li>
                                <a href="<?= Url::to(['/site/coleccionesdisciplina', 'dis' => $disciplina->dis_id]) ?>"><?= $disciplina->dis_nombre ?> </a>
                            </li>
                        </ul>
                    </div>

                    <!-- <div class="float-right share">
                       <a href="" title="Share on Twitter"><i class="icofont-twitter"></i></a>
                       <a href="" title="Share on Facebook"><i class="icofont-facebook"></i></a>
                       <a href="" title="Share on Instagram"><i class="icofont-instagram"></i></a>
                     </div>-->

                </div>

                </article><!-- End blog entry -->

                <div class="blog-author clearfix">

                    <img src="<?= Url::to(Url::base() . '/../../backend/web/img/user/' . $investigador->use_foto) ?>"
                         alt=""
                         width="150" height="150" style="object-fit: cover" class="rounded-circle float-left">
                    <h4>
                        <a href="<?= Url::to(['/site/coleccionesinvestigador', 'inv' => $datosInv->inv_id]) ?>"> <?= $investigador->use_nombre . ' ' . $investigador->use_apellido ?></a>
                    </h4>
                    <div class="social-links">
                        <?php if ($datosInv->inv_twitter != '') { ?>
                            <a href="<?= Url::to($datosInv->inv_twitter) ?>" target="_blank"><i
                                        class="icofont-twitter"></i></a>
                        <?php } ?>
                        <?php if ($datosInv->inv_facebook != '') { ?>
                            <a href="<?= Url::to($datosInv->inv_facebook) ?>" target="_blank"><i
                                        class="icofont-facebook"></i></a>
                        <?php } ?>
                        <?php if ($datosInv->inv_instagram != '') { ?>
                            <a href="<?= Url::to($datosInv->inv_instagram) ?>" target="_blank"><i
                                        class="icofont-instagram"></i></a>
                        <?php } ?>
                        <?php if ($datosInv->inv_web != '') { ?>
                            <a href="<?= Url::to($datosInv->inv_web) ?>" target="_blank"><i class="icofont-web"></i></a>
                        <?php } ?>
                    </div>
                    <p>
                        <?= $datosInv->inv_descripcion ?> <br>
                        <strong>Correo electrónico: </strong><?=$item->col->inv->usu->email ?>
                    </p>
                    <p>
                        <a href="<?= Url::to(['/site/coleccionesinvestigador', 'inv' => $datosInv->inv_id]) ?>"> <i
                                    class="icofont-arrow-right"></i> Ver más</a>
                    </p>
                </div><!-- End blog author bio -->
            </div><!-- End blog entries list -->
        </div><!-- End row -->
        </div><!-- End container -->
    </section><!-- End Blog Section -->

</main><!-- End #main -->


