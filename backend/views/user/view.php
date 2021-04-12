<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\user\User */

$this->title = $model->use_nombre . ' ' . $model->use_apellido;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main id="main">
    <div class="user-view">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>                    
                    <p>
                        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Update'), ['actualizar', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
                        <?=
                        Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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

                <?php

                if($model->rol_id == 2){
                    if ($model->use_estado == 3) {
                        echo '<div class="alert alert-danger"><h2>Solicitud Negada! </h2>'
                        . '<h5>Modifique el estado de la solicitud para que el investigar pueda subir colecciónes y archivos de investigación</h5></div>';
                    } else {
                        if($model->use_estado == 1) {
                            echo '<div class="alert alert-warning"><h2>Solicitud Pendiente! </h2>'
                        . '<h5>Debe modificar el estado de la solicitud para que el investigar pueda subir colecciónes y archivos de investigación</h5></div>';
                        }
                        
                    }
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'use_nombre',
                            'use_apellido',
                            'uge.uge_nombre',
                            'use_telefono',
                            'email:email',
                            [
                                'label'  => 'País',
                                'attribute' => 'pai.pai_nombre',
                            ],
                            [
                                'attribute'=>'use_foto',
                                'value'=>Url::to('@web/img/user/'.$model->use_foto),
                                'format' => ['image',['width'=>'150','height'=>'150']],

                            ],
                            'rol.rol_nombre',
                            [
                                'attribute' => 'use_estado',
                                'value' => (($model->use_estado ==2) ? 'Aprobado': (($model->use_estado ==3) ? 'Negado':'Solicitud Pendiente')),
                            ],
                        ],
                    ]);

                }else{
                    echo DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'use_nombre',
                            'use_apellido',
                            [
                                'label'  => 'Género',
                                'attribute' => 'uge.uge_nombre',
                            ],
                            'use_telefono',
                            'email:email',
                            [
                                'label'  => 'País',
                                'attribute' => 'pai.pai_nombre',
                            ],
                            [
                                'attribute'=>'use_foto',
                                'value'=>Url::to('@web/img/user/'.$model->use_foto),
                                'format' => ['image',['width'=>'150','height'=>'150']],

                            ],
                            'rol.rol_nombre',
                        ],
                    ]);
                }

                ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>
