<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\grid\GridView;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\coleccion\Coleccion */
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
                        <?php
                        if ($model->col_estadocol == 'A') {
                            //Mensaje de confirmación
                            if (!Yii::$app->session->getIsActive()) {
                                Yii::$app->session->open();
                            }
                            Yii::$app->session['c_id'] = $model->col_id;
                            Yii::$app->session['c_titulo'] = $model->col_titulo;
                            Yii::$app->session->close();

                            echo Html::a('<span class="glyphicon glyphicon-file"></span> ' . 'Archivos', ['/archivo'], ['class' => 'btn btn-primary']);
                        }
                        ?>
                        <?php
                        if ($model->col_estadocol != 'B') {
                            echo Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->col_id], ['class' => 'btn btn-secondary']);
                        }
                        ?>
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

                <?php if($model->col_estadocol == 'P') {?>
                    <div class="alert alert-warning alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-time-five"></i>Coleccion en espera!</h4>
                        La colección está en la espera de ser por aprobada por un administrador. Gracias por su comprensión.
                    </div>
                <?php }
                if($model->col_estadocol == 'A') { ?>
                    <div class="alert alert-info alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                        <h4><i class="bx bx-check-square"></i>Coleccion aprobada!</h4>
                        La coleccion está aprobada.
                    </div>
                <?php } ?>
                <?php
                if($model->col_estadocol == 'N') { ?>
                <div class="alert alert-dark alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="bx bx-check-square"></i>Coleccion negada!</h4>
                    La coleccion está negada. Por favor revise las observaciones enviadas a su email.
                </div>
                <?php } ?>
                <?php
                if($model->col_estadocol == 'B') { ?>
                <div class="alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
                    <h4><i class="bx bx-check-square"></i>Coleccion bloqueada!</h4>
                    La coleccion está aprobada. Por favor revise las observaciones enviadas a su email.
                </div>
                <?php } ?>
            <section class="about" data-aos="fade-up">
                <div class="container">
                    <?php

                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute'=>'col_portada',
                                    'value'=>Url::to(Url::base().'/../../backend/web/img/coleccion/'.$model->col_portada),
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
                                    'label' => 'Atributo'
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


    </div>
    </section>
    <!-- End Bod Page Section -->
    </div>
</main>


























<?php
        /*

        <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
            <div class="container">
                <article class="entry entry-single">




                    <div class="entry-img">
                        <img src="<?=Url::to('../../../backend/web/img/coleccion/'.$model->col_portada)?>" alt="" width="200" class="img-fluid">
                    </div>

                    <h2 class="entry-title">
                        <a href="blog-single.html"><?=$model->col_titulo?></a>
                    </h2>

                    <div class="entry-meta">
                        <ul>
                            <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="">John Doe</a></li>
                            <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href=""><time datetime=""><?=$model->col_fechaCreacion?></time></a></li>
                        </ul>
                    </div>

                    <div class="entry-content">
                        <p>
                            <h4><?=$model->col_descripcion?></h4>
                        </p>

                        <h3>Fecha de creación</h3>
                        <p>
                            <h4><?=$model->col_fechaPublicacion?></h4>
                        </p>
                        <h3>Disciplina</h3>
                        <p>
                            <h4> <?=$model->dis_id?></h4>
                        </p>
                        <h3>Fuente</h3>
                        <p>
                            <h4><?=$model->col_fuente?></h4>
                        </p>

                    </div>
                </article><!-- End blog entry -->
            </div><!-- End container -->
        </section> <!-- End Body Page Section -->





    </div>
</main>

<!-- ==================================================================================================================== -->

*/

?>