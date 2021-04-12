<?php

use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\archivo\Archivo */
/* @var $idioma backend\models\idioma\Idioma */
/* @var $genero backend\models\genero\Genero*/
/* @var $pais backend\models\pais\Pais*/
/* @var $derecho backend\models\derecho\Derecho*/
/* @var $tipoArchivo backend\models\tipoarchivo\Tipoarchivo*/

$this->title = Yii::t('app', 'Create');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Archivos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
    <div class="archivo-create">
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

    <?= $this->render('_form_guardar', [
        'tipo' => $tipo,
        'model' => $model,
        'pais' => $pais,
        'genero' => $genero,
        'idioma' => $idioma,
        'derecho' => $derecho,
        'ae' => $ae,
        'atributoExtra' => $atributoExtra,
    ]) ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>
