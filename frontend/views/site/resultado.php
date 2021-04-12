<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);

$this->title = 'Resultados para: ' . $buscar_texto;
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
                                Busqueda avanzada
                            </a>
                            <?php /* ?>
                            <input class="form-check-input" type="checkbox" id="checkboxAvanzada" value="" aria-label="...">
                            <label class="form-check-label text-info" for="flexRadioDefault2">
                                Busqueda avanzada
                            </label>
                             * 
                           <?php  */ ?>
                        </div>


                        <?php /* ?>
                        <div class="row col-sm-12 col-md-12">                
                            <!-- Section: Live preview -->
                            <div id="formularios_busqueda_avanzados" class="text-info">                            
                                    <?php $form = ActiveForm::begin(['validateOnBlur' => false]); ?>
                                <div class="text-justify">
                                    <?= $form->field($model_coleccion, 'col_titulo')->textInput(['maxlength' => true])->label('') ?>
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
                                <center>
                                    <div class="">
<?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?> 
                                    </div>
                                </center>
<?php ActiveForm::end(); ?>

                            </div>
                            <!-- Section: Live preview -->

                        </div>
                        
                        <?php */ ?>


                    </div>
                </section> <!-- Fin de buscar -->
                <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
            </div>
        </div>
    </section><!-- End About Us Section -->
    <!-- ======= Our Skills Section ======= -->
    <section class="skills" data-aos="fade-up">
        <div class="container">


            <div class="col-md-12">
                <!-- ======= <table class="table table-responsive table-condensed table-hover" border="1"> ======= -->
                <table class="table table-condensed table-hover" border="0">
                    <tbody>
                    <?php
                    foreach ($coleccion as $col) {
                        ?>
                        <tr>

                            <td rowspan="1">
                                <a href="<?= Url::base() ?>/index.php/site/coleccionview?id= <?= $col->col_id ?> ">
                                    <img src="<?= Url::base() ?>/../../backend/web/img/coleccion/<?= $col->col_portada ?>"
                                         width="100" height="100">
                                </a>
                            </td>
                            <td colspan="2">
                                <div class="col-sm-12 text-justify">

                                    <p  align="right">
                                        <a href="<?= Url::base() ?>/index.php/site/coleccionview?id= <?= $col->col_id ?>">
                                            <i class="icofont-arrow-right"></i> Ver más
                                        </a>
                                    </p>
                                    <p style="display:inline">
                                        <b>Colección: </b>
                                        <?= $col->col_titulo ?>
                                    </p>

                                </div>
                                <p>
                                <div class="row col-sm-12">
                                    <div class="col-sm-4">
                                        <b>Categoria: </b>
                                        <?= $col->dis->dis_nombre ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <b>Investigador: </b>
                                        <?= $col->inv->usu->use_nombre . ' ' . $col->inv->usu->use_apellido ?>
                                    </div>
                                    <div class="col-sm-4">
                                        <b>Fecha de publicacion:<br> </b>
                                        <?= $col->col_fechaPublicacion ?>
                                    </div>
                                    </p>
                            </td>

                        </tr>
                        <?php
                    } //Fin de cada colección
                    ?>
                    </tbody>
                </table>
            </div>


        </div>
    </section>

</main><!-- End #main -->      
