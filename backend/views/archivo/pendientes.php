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

$this->title = 'Archivos pendientes';
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

                <?php echo $this->render('_search_pendientes', ['model' => $searchModel]); ?>
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
//                        [
//                            'class' => 'yii\grid\ActionColumn',
//                            'template' => '{view} {update} {delete}',
//                            'visibleButtons'=>[
//                                'update'=> function($model){
//                                    return $model->arc_estadoarc!='B';
//                                },
//                            ]
//                        ],
                        ['class' => 'yii\grid\ActionColumn', 'buttons' =>
                                [
                                'cambiar' => function($url, $model, $key) {
                                    $imagen = Html::img(Url::base().'/img/iconos/editar.png', ['width' => '20px', 'height' => '20px']);
                                    return Html::a($imagen, $url, ['class' => 'btn', 'data' => ['method' => 'post', 'params' => ['derp' => 'herp'],], 'title' => 'Cambiar de estado']); //use Url::to() in order to change $url 
                                },
                            ], 'template' => '
                        {cambiar}
                        ', 'header' => ''
                        ]
                    ],
                ]);
                ?>


            </div>
        </section>
        <!-- End Bod Page Section -->

    </div>
</main>
