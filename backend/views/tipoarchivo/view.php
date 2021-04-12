<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\tipoarchivo\Tipoarchivo */


$this->title = $model->tar_tipo;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tipoarchivos'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main id="main">
    <div class="tipoarchivo-view">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p>
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' .Yii::t('app', 'Update'), ['update', 'id' => $model->tar_id], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' .Yii::t('app', 'Delete'), ['delete', 'id' => $model->tar_id], [
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
                        // 'tar_id',
                        'tar_tipo',
                        'tar_extension',
                    ],
                ]);

               /* if($Ext != 0 ) {
                    $gvPC = new \yii\data\ArrayDataProvider([
                        'allModels' => $Ext,
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
                                'attribute' => 'tae_extension',
                                'label' => 'Entensión'
                            ],
                        ]
                    ]);
                }*/

                echo GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'aex_nombre',
                            'label' => 'Nombre',
                        ],
                        [
                            'attribute' => 'aex_descripcion',
                            'label' => 'Descripción',
                        ],



                    ],
                ]);


                ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>

