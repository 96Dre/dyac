<?php

use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\tipoarchivo\Tipoarchivo */
/* @var $modelAtributos backend\models\atributoextra\atributoExtra */
/* @var $atributosExtra backend\models\archivoatributoex\Archivoatributoex */

$this->title = Yii::t('app', 'Update: {name}', [
    'name' => $model->tar_tipo,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipoarchivos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->tar_id, 'url' => ['view', 'id' => $model->tar_id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<main id="main">
    <div class="tipoarchivo-update">
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
                    'atributosExtra' => $atributosExtra,
                    //'tipoExt' => $tipoExt,
                ]) ?>


            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>
