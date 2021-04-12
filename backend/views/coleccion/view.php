<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\coleccion\Coleccion */
/* @var $coleccionpais frontend\models\coleccionpais\Coleccionpais */
/* @var $palabraclave frontend\models\palabraclave\Palabraclave */
/* @var $atrExtra frontend\models\coleccionatributoex\Coleccionatributoex */
/* @var $coleccionpersona  */

$this->title = $model->col_titulo;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coleccions'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<main id="main">
    <div class="coleccion-view">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p>
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' .Yii::t('app', 'Update'), ['update', 'id' => $model->col_id], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' .Yii::t('app', 'Delete'), ['delete', 'id' => $model->col_id], [
                            'class' => 'btn btn-secondary',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]) ?>
                        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </p>
                </div>
            </div>
        </section>
        <!-- End Header Page Section -->

        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">

                <?= Yii::$app->session->getFlash('msg') ?>

                <?php

                echo DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute'=>'col_portada',
                            'value'=>Url::to(Url::base().'/img/coleccion/'.$model->col_portada),
                            'format' => ['image',['width'=>'150','height'=>'150']],
                        ],
                        'col_titulo',
                        'col_descripcion',
                        'col_fechaPublicacion',
                        [
                            'label'  => 'Disciplina',
                            'attribute' => 'dis.dis_nombre',
                        ],
                        'col_fuente',
                        [
                            'attribute'=>'col_fechaCreacion',
                            'label'  => 'Fecha de publicación',
                        ],
                        [
                            'attribute' => 'col_estadoCol',
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
                            'label'  => 'Estado de la publicación',
                        ],
                    ],
                ]);


                if($coleccionpais != 0 ){
                    $gvCP = new \yii\data\ArrayDataProvider([
                        'allModels' => $coleccionpais,
                        'sort' => [
                            //'attributes' => ['pai.pai_nombre','cpa_ubicacion'],
                        ],
                        'pagination' => ['pageSize' => 10]
                    ]);
                    echo '<br>';
                    echo GridView::widget([
                        'dataProvider' => $gvCP,
                        'layout' => '{items}{pager}',
                        'columns' => [
                            [
                                'attribute' => 'pai.pai_nombre',
                                'label' => 'País'
                            ],
                            [
                                'attribute' => 'cpa_ubicacion',
                                'label' => 'Ubicación'
                            ],
                        ]
                    ]);
                }



                if($palabraclave != 0 ){
                    $gvPC = new \yii\data\ArrayDataProvider([
                        'allModels' => $palabraclave,
                        'sort' => [
                            //'attributes' => ['pai.pai_nombre','cpa_ubicacion'],
                        ],
                        'pagination' => ['pageSize' => 10]
                    ]);
                    echo '<br>';
                    echo GridView::widget([
                        'dataProvider' => $gvPC,
                        'layout' => '{items}{pager}',
                        'columns' => [
                            [
                                'attribute' => 'pcl_palabraClave',
                                'label' => 'Palabras Clave'
                            ],
                        ]
                    ]);
                }

                if($atrExtra != 0 ){
                    $gvAE = new \yii\data\ArrayDataProvider([
                        'allModels' => $atrExtra,
                        'sort' => [
                            //'attributes' => ['pai.pai_nombre','cpa_ubicacion'],
                        ],
                        'pagination' => ['pageSize' => 10]
                    ]);
                    echo '<br>';
                    echo GridView::widget([
                        'dataProvider' => $gvAE,
                        'layout' => '{items}{pager}',
                        'columns' => [
                            [
                                'attribute' => 'aex.aex_nombre',
                                'label' => 'Atributo extra'
                            ],
                            [
                                'attribute' => 'cae_descripcion',
                                'label' => 'Descripción'
                            ],
                        ]
                    ]);
                }

                if($coleccionpersona != 0 ){
                    $gvCPer = new \yii\data\ArrayDataProvider([
                        'allModels' => $coleccionpersona,
                        'sort' => [
                            //'attributes' => ['pai.pai_nombre','cpa_ubicacion'],
                        ],
                        'pagination' => ['pageSize' => 10]
                    ]);
                    echo '<br>';

                    echo GridView::widget([
                        'dataProvider' => $gvCPer,
                        'layout' => '{items}{pager}',
                        'columns' => [
                            [
                                'attribute' => 'nombre',
                                'label' => 'Colaborador',
                            ],
                        ]
                    ]);
                }


                ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>
