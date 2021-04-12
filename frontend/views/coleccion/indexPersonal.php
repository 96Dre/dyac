<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\coleccion\ColeccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis Colecciones';
//$this->title = Yii::t('app', 'Coleccions');
//$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
    <div class="coleccion-index">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?> <a href='<?= Url::to(['site/ayuda']) ?>' target='_blank'  title="Ayuda">
                            <span class="glyphicon glyphicon-question-sign"></span></a></h1>

                    <p>


                        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-secondary']) ?>
                        <a href="<?= Url::to(['site/index']) ?>" class="btn btn-secondary"><span
                                    class="glyphicon glyphicon-arrow-left"></span> Regresar</a>

                    </p>
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


                <?php
                $botones = '{view} {update} {delete}';
                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'rowOptions' => function ($model) {
                        /*if($model->col_estadocol == 'P'){
                            return ['class' => 'warning'];
                        }
                        if($model->col_estadocol == 'N'){
                            return ['class' => 'danger'];
                        }*/
                        if ($model->col_estadocol == 'A') {
                            return ['class' => 'info'];
                        }
                        if ($model->col_estadocol == 'B') {
                            return ['class' => 'danger'];
                        }
                    },
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'col_titulo',
                        [
                            'attribute' => 'col_fechaCreacion',
                            'label' => 'Fecha de publicación'
                        ],
                        [
                            'attribute' => 'col_estadocol',
                            'value' => function ($model) {
                                if ($model->col_estadocol == 'P') {
                                    return 'Pendiente';
                                }
                                if ($model->col_estadocol == 'A') {
                                    return 'Aprobado';
                                }
                                if ($model->col_estadocol == 'N') {
                                    return 'Negado';
                                }
                                if ($model->col_estadocol == 'B') {
                                    return 'Bloqueado';
                                }
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'visibleButtons' => [
                                'update' => function ($model) {
                                    return $model->col_estadocol != 'B';
                                },
                            ]
                        ],

                    ],

                ]); ?>

            </div>
        </section>
        <!-- End Bod Page Section -->

    </div>
</main>


