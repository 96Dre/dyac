<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use backend\models\menu\Menu;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\menu\Menu */

$this->title = $model->men_nombre;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
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
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' .Yii::t('app', 'Update'), ['update', 'id' => $model->men_id], ['class' => 'btn btn-secondary']) ?>
                        <?= Html::a('<span class="glyphicon glyphicon-trash"></span> ' .Yii::t('app', 'Delete'), ['delete', 'id' => $model->men_id], [
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
                if ($model->men_idPadre==0){
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'men_nombre',
                            [
                                'attribute' => 'men_activo',
                                'value' => (($model->men_activo ==1) ? 'Si': 'No'),
                            ],

                        ],
                    ]);
                }else{

                    $padre = Menu::find()->where(['men_id'=>$model->men_idPadre])->andFilterWhere(['men_posicion'=>0])->one();

                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            //'men_id',
                            'men_nombre',
                            'men_descripción',
                            'men_icono',
                            'men_color',
                            'men_url:url',
                            [
                                'attribute' => 'men_idPadre',
                                'value' => $padre->men_nombre,
                            ],
                            //'men_posicion',
                            [
                                'attribute' => 'men_activo',
                                'value' => (($model->men_activo ==1) ? 'Si': 'No'),
                            ],
                        ],
                    ]);
                }
                 ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>

