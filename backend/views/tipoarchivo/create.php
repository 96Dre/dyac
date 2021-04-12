<?php

use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\tipoarchivo\Tipoarchivo */
/* @var $modelAtributos backend\models\atributoextra\atributoExtra */

$this->title = Yii::t('app', 'Create');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipoarchivos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
    <div class="tipoarchivo-create">
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

                <?= $this->render('_form', [
                    'model' => $model,
                    'modelAtributos' => $modelAtributos,
                   // 'tipoExt' => $tipoExt,
                ]) ?>


            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>
