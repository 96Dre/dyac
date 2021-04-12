<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\preguntafrecuente\PreguntaFrecuente */

$this->title = $model->pfr_pregunta;
$this->params['breadcrumbs'][] = ['label' => 'Pregunta Frecuentes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main id="main">
    <div class="pais-view">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p>
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->pfr_id], ['class' => 'btn btn-secondary']) ?>
                        <?=
                        Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->pfr_id], [
                            'class' => 'btn btn-secondary',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ])
                        ?>
                        <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </p>
                </div>
            </div>
        </section>
        <!-- End Header Page Section -->

        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">

                <?= Yii::$app->session->getFlash('msg') ?>

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                       // 'pfr_id',
                        'pfr_pregunta',
                        'pfr_respuesta',
//                        'pfr_estado',
//                        'pfr_fechaCreacion',
//                        'pfr_fechaAudit',
//                        'pfr_accion',
                    ],
                ])
                ?>
            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>