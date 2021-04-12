<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\preguntafrecuente\PreguntaFrecuente */

$this->title = 'Modificando pregunta frecuente N°: ' . $model->pfr_id;
$this->params['breadcrumbs'][] = ['label' => 'Pregunta Frecuentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pfr_id, 'url' => ['view', 'id' => $model->pfr_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<main id="main">
    <div class="pais-update">
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

                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>