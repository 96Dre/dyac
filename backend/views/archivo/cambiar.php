<?php

use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\archivo\Archivo */

$this->title = Yii::t('app', 'Editar');
//$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->arc_id, 'url' => ['view', 'id' => $model->arc_id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<main id="main">
    <div class="archivo-update">
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


                <?= $this->render('_form_cambiar', [
                    'tipo' => $tipo,
                    'model' => $model,
                    'pais' => $pais,
                    'genero' => $genero,
                    'idioma' => $idioma,
                    'derecho' => $derecho,
                    'ae' => $ae,
                    //'atributoExtra' => $atributoExtra,
                    'detalleAE' => $detalleAE ,
                ]) ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>
