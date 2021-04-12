<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\assets\AppAsset;

AppAsset::register($this);

$this->title = $titulo;
$discList = backend\models\disciplina\Disciplina::find()->select(['dis_id', 'dis_nombre'])->orderBy('dis_nombre')->all();
?>
<?php
// Buscar Investigadores
$this->registerJs("
    $('#buscar').keyup(function () {                                                
    $.ajax({
    type: 'POST',
    url: '" . Url::base() . "/coleccion/buscarinvestigadores',
    data: {
    parametro: $('#buscar').val()
    },
    success: function (responseText) {   
    var obj = JSON.parse(responseText);
    var n = obj[0][0];
    var i;
    var tabla = '';
    var cont=1;
    tabla += '<br><div class=\"col-md-12\" ><center><h5>INVESTIGADORES</h5></center></div>';                                                              
    tabla += '<div class=\"col-md-12\" >';    
        tabla += '<table class = \"table  table-hover\" width=\"100%\">'; 
                         tabla += '<thead>'; 
                tabla += '<th width=\"20%\">Autor</th><th width=\"40%\">Título profesional</th><th width=\"40%\">Descripción</th>';
            tabla += '</thead>'; 
            tabla += '<tbody>';
                for (i = 1; i <= n; i++) { 
                tabla += '<tr>';
                    tabla += '<td><a href=\'site/coleccionesinvestigador?inv='+obj[i]['inv_id']+'\'>'+obj[i]['nombres']+'</a></td>';
                    tabla += '<td>'+obj[i]['inv_tituloProfesional']+'</td>';
                    tabla += '<td>'+obj[i]['inv_descripcion']+'</td>';
                    tabla += '</tr>';
                cont = cont+1;
                } //Fin de cada coleccion
                tabla += '</tbody>';
            tabla += '</table>';    
        tabla += '</div>'; 
    $('#resultado_investigadores').html(tabla);
    }
    });                            
    });
    ");
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
                                    <?= $form->field($model_coleccion, 'col_titulo')->textInput(['maxlength' => true, 'placeholder' => 'Ingresar colección, investigador, palabras claves'])->label(false) ?>
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

                                Búsqueda avanzada
                            </a>
                            <!--                            <input class="form-check-input" type="checkbox" id="checkboxAvanzada" value="" aria-label="...">
                                                        <label class="form-check-label text-info" for="flexRadioDefault2">
                                                            Busqueda avanzada
                                                        </label>-->
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
            <p display="flex" justify-content="center" align-items="center">
                <?php
                echo str_repeat('&nbsp;', 40) . '| ';
                ?>
                <a href="<?= Url::to(Url::base() . '/index.php/site/investigador') ?>">
                    TODOS
                </a>
                <?php
                echo '| ';
                foreach (range('A', 'Z') as $letra) {
                    ?>
                    <a href="investigadorlike?like=<?= $letra ?> "><?= $letra ?></a> |
                <?php } ?>
            </p>


            <div class="row">
                <div class="col-lg-12 entries">
                    <section class="team" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
                        <div class="container">
                            <div class="row">
                                <?php if (count($user) != 0) { ?>
                                    <?php foreach ($user as $item) { ?>
                                        <?php foreach ($investigador as $inv) { ?>
                                            <?php if ($item->id == $inv->usu_id) { ?>
                                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                                                    <div class="member">
                                                        <div class="member-img">
                                                            <center><img
                                                                        src="<?= Url::base() ?>/../../backend/web/img/user/<?= $item->use_foto ?>"
                                                                        class="" height="150px"
                                                                        width="150px"
                                                                        style="object-fit: cover"
                                                                        alt="<?= $item->use_nombre . ' ' . $item->use_apellido ?>">
                                                            </center>
                                                            <div class="social">
                                                                <?php if ($inv->inv_twitter != '') { ?>
                                                                    <a href="<?= Url::to($inv->inv_twitter) ?>"
                                                                       target="_blank"><i
                                                                                class="icofont-twitter"></i></a>
                                                                <?php } ?>
                                                                <?php if ($inv->inv_facebook != '') { ?>
                                                                    <a href="<?= Url::to($inv->inv_facebook) ?>"
                                                                       target="_blank"><i class="icofont-facebook"></i></a>
                                                                <?php } ?>
                                                                <?php if ($inv->inv_instagram != '') { ?>
                                                                    <a href="<?= Url::to($inv->inv_instagram) ?>"
                                                                       target="_blank"><i class="icofont-instagram"></i></a>
                                                                <?php } ?>
                                                                <?php if ($inv->inv_web != '') { ?>
                                                                    <a href="<?= Url::to($inv->inv_web) ?>"
                                                                       target="_blank"><i class="icofont-web"></i></a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <section class="service-details">
                                                            <div class="container">
                                                                <div class="card-body">
                                                                    <h5 class="card-title"><a
                                                                                href=""><?= $item->use_apellido . ' ' . $item->use_nombre ?></a>
                                                                    </h5>
                                                                    <p class="card-text"><?= substr($inv->inv_tituloProfesional, 0, 17) . '...' ?> </p>
                                                                    <p style="font-size: smaller"><?= $item->email ?></p>
                                                                    <div class="read-more">
                                                                        <a href="<?= Url::to(['/site/coleccionesinvestigador', 'inv' => $inv->inv_id]) ?>"><i
                                                                                    class="icofont-arrow-right"></i> Ver
                                                                            más</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>

                                    <?php } ?>
                                <?php } else { ?>
                                    <h4><p> No hay investigadores disponibles.</p></h4>

                                <?php } ?>
                            </div>
                        </div>
                    </section>
                </div><!-- End blog entries list -->

                <?php /*
                <!-- **************************************************************************************
                <?php /*
                  <div class="col-lg-4">
                  <div class="sidebar">
                  <h3 class="sidebar-title">Buscar</h3>
                  <!-- <div class="sidebar-item search-form"> -->
                  <?php $form = ActiveForm::begin([]); ?>
                  <?= $form->field($model, 'use_nombre')->textInput(['maxlength' => true])->label(false) ?>
                  <div class="form-group">
                  <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
                  </div>
                  <?php ActiveForm::end(); ?>
                  <!--  </div>End sidebar search formn-->
                  <h3 class="sidebar-title">Disciplinas</h3>
                  <div class="sidebar-item categories">
                  <ul>
                  <?php foreach ($discList as $item) { ?>
                  <li>
                  <a href="coleccionesdisciplina?dis=<?= $item->dis_id ?>"><?= str_repeat('&nbsp;', 5) . '• ' . $item->dis_nombre ?></span></a>
                  </li>
                  <?php } ?>
                  </ul>
                  </div> <!-- End sidebar categories-->
                  <?php

                  $investigador = \frontend\models\investigador\Investigador::find()
                  ->select(['inv_id', 'usu_id', 'inv_descripcion', 'inv_fechaCreacion'])
                  ->limit(5)
                  ->orderBy('inv_fechaCreacion DESC')
                  ->all();

                  ?>
                  <h3 class="sidebar-title">Investigadores registrados recientemente</h3>
                  <div class="sidebar-item recent-posts">
                  <?php foreach ($investigador as $i) { ?>
                  <?php
                  $user = \backend\models\user\User::find()
                  ->select(['use_nombre', 'use_apellido', 'use_foto'])
                  ->where(['id' => $i->usu_id])
                  ->one();
                  ?>
                  <div class="post-item clearfix">
                  <img src="<?= Url::to(Url::base().'/../../backend/web/img/user/' . $user->use_foto) ?>"
                  alt="">
                  <h4>
                  <a href="<?= Url::to(['/site/coleccionesinvestigador', 'inv' => $i->inv_id]) ?>"> <?= $user->use_nombre . ' ' . $user->use_apellido ?> </a>
                  </h4>
                  <h4>
                  <a href="<?= Url::to(['/site/coleccionesinvestigador', 'inv' => $i->inv_id]) ?>">
                  Ver colecciones </a></h4>

                  </div>
                  <?php } ?>
                  </div><!-- End sidebar recent posts-->
                  </div><!-- End sidebar -->

                  </div><!-- End blog sidebar -->




                <div class="row">
                    <div class="col-lg-12 entries">
                        <section class="service-details">
                            <div class="container">
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
                                                        <p class="card-text"><?= substr($item->col_descripcion, 0, 40) . '...' ?> </p>
                                                        <div class="read-more">
                                                            <a href="<?= Url::to(['/site/coleccionview', 'id' => $item->col_id]) ?>"><i
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


                </div><!-- End row -->

                *********************************************************************************** --> */ ?>


            </div><!-- End row -->
        </div><!-- End container -->
    </section><!-- End Blog Section -->

</main><!-- End #main -->