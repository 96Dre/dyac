<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\preguntafrecuente\PreguntaFrecuente */

$this->title = 'Crear pregunta frecuente';
$this->params['breadcrumbs'][] = ['label' => 'Pregunta Frecuentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
    <div class="pais-create">
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
