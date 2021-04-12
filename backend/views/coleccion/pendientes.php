<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\coleccion\ColeccionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Colecciones pendientes';
//$this->title = Yii::t('app', 'Coleccions');
//$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
    <div class="coleccion-index">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>
                        <?php // echo Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-secondary'])  ?>
                        <a href="<?= Url::to(['site/index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </p>
                </div>
            </div>
        </section>
        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">

                <?php echo $this->render('_searchPendientes', ['model' => $searchModel]); ?>
                <br>
                <br>


                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'rowOptions' => function($model) {
                        if ($model->col_estadocol == 'P') {
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
                        //  ['class' => 'yii\grid\ActionColumn'],
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

