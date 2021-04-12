<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\archivo\ArchivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Archivos');
//$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
    <div class="archivo-index">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <?php $form = ActiveForm::begin(); ?>
                    <p>
                        <a href="<?= Url::to(['/site']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </p>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </section>
        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">

                <?= Yii::$app->session->getFlash('msg') ?>

                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
                <br>
                <br>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'rowOptions' => function($model) {
                        /*
                          if($model->arc_estadoarc == 'N'){
                          return ['class' => 'danger'];
                          }if($model->arc_estadoarc == 'B'){
                          return ['class' => 'danger'];
                          } */
                        if ($model->arc_estadoarc == 'P') {
                            return ['class' => 'danger'];
                        }
                        /* if($model->arc_estadoarc == 'A'){
                          return ['class' => 'info'];
                          } */
                    },
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                            'attribute' => 'col.col_titulo',
                            'label' => 'Colección'
                        ],
                            [
                            'attribute' => 'tar.tar_tipo',
                            'label' => 'Tipo de archivo'
                        ],
                        'arc_fechaCreacion',
                            [
                            'attribute' => 'arc_estadoarc',
                            'value' => function ($model) {
                                if ($model->arc_estadoarc == 'P') {
                                    return 'Pendiente';
                                }
                                if ($model->arc_estadoarc == 'A') {
                                    return 'Aprobado';
                                }
                                if ($model->arc_estadoarc == 'N') {
                                    return 'Negado';
                                }
                                if ($model->arc_estadoarc == 'B') {
                                    return 'Bloqueado';
                                }
                            },
                        ],
                            [
                            'attribute' => 'inv.usu.use_apellido',
                            'value' => function($model) {
                                if (isset($model->col->inv->usu->use_apellido)){
                                    $inv = $model->col->inv->usu->use_apellido . ' ' . $model->col->inv->usu->use_nombre;
                                } else {
                                    $inv="N/A";
                                }
                                return $inv;
                            },
                            'label' => 'Investigador'
                        ],
                            [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'visibleButtons' => [
                                'update' => function($model) {
                                    return $model->arc_estadoarc != 'B';
                                },
                            ]
                        ],
                    ],
                ]);
                ?>


            </div>
        </section>
        <!-- End Bod Page Section -->

    </div>
</main>
