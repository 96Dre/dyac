<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\archivo\ArchivoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Archivos') . ' para "' . $c_titulo . '"';
//$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
    <div class="archivo-index">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?> <a href='<?= Url::to(['site/ayuda']) ?>' target='_blank'  title="Ayuda">
                            <span class="glyphicon glyphicon-question-sign"></span></a></h1>

                    <?php $form = ActiveForm::begin(); ?>
                    <p>
                        <?=
                        $form->field($model, 'tar_id')->dropDownList($tipoArchivo, ['prompt' => '- Seleccionar -'
                        ])->label('Tipo de archivo')
                        ?>
                      <?php   
                      $this->registerJs("                          
                         var btn_guardar_archivo = document.getElementById('btnGuardarArchivo');
                         var btn_vincular_archivo = document.getElementById('btnVincularArchivo');
                         
                         btn_guardar_archivo.style.display = 'none'; // Ocultar
                         btn_vincular_archivo.style.display = 'none'; // Ocultar
                        
                        $('#archivo-tar_id').change(function () {   
                         var sel = $('#archivo-tar_id').val();
                        //  if (sel == 2 || sel == 3) { // Es audio o video                       
                        //    btn_guardar_archivo.style.display = 'none'; // Mostrar   
                        //    btn_vincular_archivo.style.display = 'inline'; // Ocultar                                                      
                        //   } else { Cualquier archivo
                            btn_guardar_archivo.style.display = 'inline'; // Ocultar
                            btn_vincular_archivo.style.display = 'none'; // Mostrar  
                        //    } 
                          });
            "); ?>
                        <a id="btnVincularArchivo" href="<?= Url::to(['guardar']) ?>" class="btn btn-secondary"><span
                                class="glyphicon glyphicon-plus"></span> Agregar</a>
                        <?=
                        Html::submitButton('<span class="glyphicon glyphicon-plus"></span> Agregar', 
                            ['id' => 'btnGuardarArchivo',
                            'class' => 'btn btn-secondary'])
                        ?>
                        <a href="<?= Url::to(['/coleccion']) ?>" class="btn btn-secondary"><span
                                class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </p>
<?php ActiveForm::end(); ?>
                </div>
            </div>
        </section>

        <?php
//        $session = Yii::$app->session;
//        echo "SWSWSW".$session['tipo_archivo_seleccionado'];
        $this->registerJs("
  $('#archivo-tar_id').change(function () {                                                
                            $.ajax({
                                type: 'POST',
                                url: 'guardar_tipo_archivo',
                                data: {
                                tipo_archivo: $('#archivo-tar_id').val()
                                },
                                success: function (responseText) {   
                                }
                            });                            
                        });


            ");
        ?>
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
                    'rowOptions' => function ($model) {
                        /* if($model->arc_estadoarc == 'P'){
                          return ['class' => 'warning'];
                          }
                          if($model->arc_estadoarc == 'N'){
                          return ['class' => 'danger'];
                          } */
                        if ($model->arc_estadoarc == 'A') {
                            return ['class' => 'info'];
                        }
                        if ($model->arc_estadoarc == 'B') {
                            return ['class' => 'danger'];
                        }
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
                            [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'visibleButtons' => [
                                'update' => function ($model) {
                                    return $model->arc_estadoarc != 'B';
                                },
                            ]
                        ],
                    ],
                ]);
                ?>


            </div>
        </section>
        <!-- End Bod Page Section -->

    </div>
</main>

