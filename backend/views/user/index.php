<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\assets\AppAsset;
use yii\helpers\ArrayHelper;
use backend\models\rol\Rol;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\user\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
//$this->params['breadcrumbs'][] = $this->title;
?>

<main id="main">
    <div class="user-index">

        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p>
                        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-secondary']) ?>
                        <a href="<?= Url::to(['site/index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </p>
                </div>
            </div>
        </section>
        <!-- End Header Page Section -->

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
                    'filterModel' => $searchModel,
                    'rowOptions' => function($model) {
                        if ($model->rol_id == 2 && $model->use_estado == 1) {
                            return ['class' => 'danger'];
                        }
                    },
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                        'use_nombre',
                        'use_apellido',
                        'email:email',
//                        'rol.rol_nombre',
                        //para mostrar Rol
                        [
                            'attribute' => 'rol_id',
                            'value' => 'rol.rol_nombre',
                            'filter' => Html::activeDropDownList(
                                    $searchModel, 'rol_id', ArrayHelper::map(Rol::find()->asArray()->orderBy('rol_nombre')->all(), 'rol_id', 'rol_nombre'), ['class' => 'form-control', 'prompt' => 'Seleccionar...']),
                        ],
                        //Fin para mostrar Rol
                        /* [
                          'attribute' => 'use_estado',
                          'value' => (($model->use_estado ==2) ? 'Aprobado': (($model->use_estado ==3) ? 'Negado':'Solicitud Pendiente')),
                          ], */

                        // ['class' => 'yii\grid\ActionColumn'],
//                        [
//                            'class' => 'yii\grid\ActionColumn',
//                            'template' => '{view} {update} {delete}',
////                            'visibleButtons'=>[
////                                'update'=> function($model){
////                                    return $model->arc_estadoarc!='B';
////                                },
////                            ]
//                        ],
                        ['class' => 'yii\grid\ActionColumn', 'buttons' =>
                                [
                                'actualizar' => function($url, $model, $key) {
                                    //$imagen = Html::img(Yii::$app->homeUrl . 'imagenes/iconos/editar.png', ['width' => '20px', 'height' => '20px']);
                                    return Html::a("<span class='glyphicon glyphicon-pencil text-info'></span> ", $url, ['class' => 'btn', 'data' => ['method' => 'post', 'params' => ['derp' => 'herp'],], 'title' => 'Cambiar de estado']); //use Url::to() in order to change $url 
                                },
                            ], 'template' => '
    {view}{actualizar}{delete}
    ', 'header' => '']
                    ],
                ]);
                ?>

            </div>
        </section>
        <!-- End Bod Page Section -->

    </div>
</main>