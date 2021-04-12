<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\user\User */
/* @var $modelInvestigador frontend\models\investigador\Investigador */
/* @var $pais backend\models\pais\Pais */
/* @var $genero backend\models\genero\Genero */
$this->title = 'Cambiar clave';
//if ($model->rol_id == 2 && $model->use_estado == 1) {
//    $this->title = 'Mi Perfil - Procesando solicitud de investigador';
//}
//if ($model->rol_id == 2 && $model->use_estado == 2) {
//    $this->title = 'Mi Perfil - Investigador';
//}
//if ($model->rol_id == 3) {
//    $this->title = 'Mi Perfil - Usuario registrado';
//}



/* $this->title = Yii::t('app', 'Update: {name}', [
  'name' => $model->use_nombre . ' ' . $model->use_apellido ,
  ]); */
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<main id="main">
    <div class="user-create">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>

                </div>
            </div>
        </section>
        <!-- End Header Page Section -->

        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">
                <?php
                if ($model->rol_id == 2 && $model->use_estado == 1) {

                    echo "<h5 class='alert alert-warning alert-dismissable'> "
                        . "Se está procesando su solicitud para Investigador."
                        . "<br>Pronto un administrador aprobará su solicitud."
                            . "<br> Debe estar toda su información actualizada, para facilitar el proceso</h5>";
                } else {
                    ?>
                    <?= Yii::$app->session->getFlash('msg') ?>
                    <?php
                };
                ?>

                <?php
                if ($model->rol_id == 2 && $model->use_estado == 2) {
                    echo $this->render('_form_clave', [
                        'model' => $model,
                        'modelInvestigador' => $modelInvestigador,
                        'pais' => $pais,
                        'genero' => $genero,
                    ]);
                } else {
                    echo $this->render('_form_clave', [
                        'model' => $model,
                        'pais' => $pais,
                        'genero' => $genero,
                    ]);
                }
                ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>
