<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use backend\assets\AppAsset;
use yii\grid\GridView;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\archivo\Archivo */

$this->title = Yii::t('app', 'Archivo') . ' para "' . $c_titulo->col_titulo . '"';
//$this->params['breadcrumbs'][] = ['label' => 'Archivos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<main id="main">
    <div class="archivo-view">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                    <p>
                        <?php
                        if ($model->arc_estadoarc != 'B') {
                            echo Html::a('<span class="glyphicon glyphicon-pencil"></span> ' . Yii::t('app', 'Update'), ['update', 'id' => $model->arc_id], ['class' => 'btn btn-secondary']);
                        }
                        ?>
                        <?=
                        Html::a('<span class="glyphicon glyphicon-trash"></span> ' . Yii::t('app', 'Delete'), ['delete', 'id' => $model->arc_id], [
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



                 <!-- ******************************************************* -->
                <!-- ******************************************************* -->
                <!-- ******************************************************* -->

                <?php
                if ($model->tar_id == 2 && $model->arc_enlace == 1) { // ***************** De tipo audio *****************
                    $url_audio = $model->arc_archivo;
                    //verificamos si es de youtube    https://www.youtube.com/watch?v=e6QcflIo3cY             
                    $buscar = 'www.youtube.com';
                    $pos = strpos($url_audio, $buscar);
                    if ($pos !== false) {
                        $url_modificado = str_replace("https://www.youtube.com/watch?v=", "", $url_audio);
                    } else {  //verificamos si es de youtube music   https://music.youtube.com/watch?v=9h_vEGcDI_U&list=RDAMVM9h_vEGcDI_U
                        $buscar = 'music.youtube.com';
                        $pos = strpos($url_audio, $buscar);
                        if ($pos !== false) {
                            //1. Eliminar el inicio de la URL
                            $url_musica = str_replace("https://music.youtube.com/watch?v=", "", $url_audio);
                            //2. Buscar la posicion de &list
                            $pos = strpos($url_musica, "&list=");
                            //3. Copiar desde el inicio hasta la posición encontrada en el literal anterior
                            $url_modificado = substr($url_musica, 0, $pos);
                        } else {
                            $url_modificado = $url_audio;
                        }
                    }
                    ?>
                    <center>
                        <div data-video = "<?= $url_modificado ?>"
                             data-autoplay = "0"
                             data-loop = "1"
                             id = "youtube-audio">
                        </div>
                        <script src = "https://www.youtube.com/iframe_api"></script>
                        <script src="https://cdn.rawgit.com/labnol/files/master/yt.js"></script>
                    </center>

                <?php
                } else { //Fin de audio como enlace
                    if ($model->tar_id == 2) {
                        ?>
                        <center><audio controls>
                            <source src="<?= Url::to(Url::base() . '../../../frontend/web/img/archivo/' . $model->arc_archivo) ?>"
                                    type="audio/mp3">
                            </audio></center>
                        <?php
                    }
                } // ***************** Fin de tipo audio **************** 
                ?>
                <?php
                if ($model->tar_id == 3 && $model->arc_enlace == 1) { // ***************** De tipo video  *****************                      
                    $url_video = $model->arc_archivo;
                    //verificamos si es de youtube                 
                    $buscar = 'youtube';
                    $pos = strpos($url_video, $buscar);
                    if ($pos !== false) {
                        $url_modificado = str_replace("watch?v=", "embed/", $url_video);
                    } else {
                        $url_modificado = $url_video;
                    }
                    ?>     
                    <center>  <iframe width="50%"
                                      src="<?= $url_modificado ?>" 
                                      frameborder="0" 
                                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                      allowfullscreen></iframe>
                    </center>
                <?php } else { //Fin de video como enlace
                    if ($model->tar_id == 3) {
                        ?>
                        <center><video controls>
                            <source src="<?= Url::to(Url::base() . '../../../frontend/web/img/archivo/' . $model->arc_archivo) ?>"
                                    type="video/mp4">
                            </video></center>
                        <?php
                    }
                } // ***************** Fin de tipo video *****************  ?>
               <?php
              // ***************** Tipo imagen *****************  
                if ($model->tar_id == 1 && $model->arc_enlace == 0) { // ***************** De tipo Imagen y no es URL *****************                        
                    echo "<center>" . Html::img(Url::base().'../../../frontend/web/img/archivo/' . $model->arc_archivo, ['alt' => 'Imagen de archivo',
                        'width' => '25%']) . "</center>";
                } // ***************** Fin de tipo imagen ***************** 
                else {
                    if ($model->tar_id == 1 && $model->arc_enlace == 1) {
                    echo "<center>" . Html::img($model->arc_archivo, ['alt' => 'Imagen de archivo',
                        'width' => '25%']) . "</center>"; 
                    }
                }
                // ***************** Fin de tipo imagen ***************** 
                ?>

                <?php
                // ***************** Tipo documento *****************  
                if ($model->tar_id > 3 && $model->arc_enlace == 0) { // ***************** De tipo Documento y no es URL *****************                        
                $url_archivo = Url::to(Url::base() . '../../../frontend/web/img/archivo/' . $model->arc_archivo);
                // Comprobar si existe un archivo
                $existe = file_exists($url_archivo);
                // if ($existe === true){
                //echo CHtml::  CHtml::link('Descargar',array($url_archivo));
                echo '<br><a href="' . $url_archivo . '" target="_blank">' . $model->arc_archivo . '</a>';
                //}
                } else {
                    if($model->arc_enlace == 1) {
                    echo '<br><a href="' . $model->arc_archivo . '" target="_blank">' . $model->arc_archivo . '</a>';
                    }
                }
                ?>

                <!-- ******************************************************* -->
                <!-- ******************************************************* -->
                <!-- ******************************************************* -->




                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                            [
                            'attribute' => 'col.col_titulo',
                            'label' => 'Colección',
                        ],
                        'arc_archivo',
                        'arc_descripcion',
                            [
                            'attribute' => 'tar.tar_tipo',
                            'label' => 'Tipo de archivo',
                        ],
                            [
                            'attribute' => 'pai.pai_nombre',
                            'label' => 'Paìs',
                        ],
                        'arc_ubicacion',
                            [
                            'attribute' => 'gen.gen_nombre',
                            'label' => 'Género del archivo',
                        ],
                            [
                            'attribute' => 'idi.idi_nombre',
                            'label' => 'Idioma',
                        ],
                            [
                            'attribute' => 'der.der_nombre',
                            'label' => 'Derechos de autor',
                        ],
                        'arc_cita',
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
                            'label' => 'Estado de la publicación',
                        ],
                    ],
                ])
                ?>
                <?php
                if ($detalleAE != 0) {
                    $dataProvider = new \yii\data\ArrayDataProvider([
                        'allModels' => $detalleAE,
                        'sort' => [
                        //'attributes' => ['pai.pai_nombre','cpa_ubicacion'],
                        ],
                        'pagination' => ['pageSize' => 10]
                    ]);
                    echo '<br>';
                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => '{items}{pager}',
                        'columns' => [
                                [
                                'attribute' => 'aex.aex_nombre',
                                'label' => 'Atributo'
                            ],
                                [
                                'attribute' => 'dae_descripcion',
                                'label' => 'Descripción'
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