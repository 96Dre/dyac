<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use backend\assets\AppAsset;

use yii\widgets\ActiveForm;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\user\User */
$this->title = 'Procesando solicitud de ' . $model->rol->rol_nombre . ': ' . $model->use_nombre . ' ' . $model->use_apellido;
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
                        <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </p>
                </div>
            </div>
        </section>
        <!-- End Header Page Section -->
        <?= Yii::$app->session->getFlash('msg') ?>
        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="col-lg-6 col-sm-6">
                            <img class="mx-auto d-block rounded-bottom"  src="<?= Url::to('@web/img/user/' . $model->use_foto) ?>" width="200" height="205" />
                        </div>
                        <div class="col-lg-6 col-sm-6">
                              <?php
                if ($model->rol_id == 1) { // Inicio de administrador
                    echo $this->render('_form_actualizar', [
                        'model' => $model,
                    ]); 
                } else { //Inicio de otros roles, distintos de administrador
                ?>
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'use_nombre',
                                    'use_apellido',
                                    'uge.uge_nombre',
                                    'use_telefono',
                                    'email:email',
                                        [
                                        'label' => 'País',
                                        'attribute' => 'pai.pai_nombre',
                                    ],
//                                    'rol.rol_nombre',
//                                        [
//                                        'attribute' => 'use_estado',
//                                        'value' => (($model->use_estado == 2) ? 'Aprobado' : (($model->use_estado == 3) ? 'Negado' : 'Solicitud Pendiente')),
//                                    ],
                                ],
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
              
                
                      <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
                    <div class="col-lg-12 col-sm-12">
                        <div class="col-lg-6 col-sm-6"></div>                        
                        <div class="col-lg-2 col-sm-2">
                            <?= $form->field($model, 'rol_id')->dropDownList([3 => 'Normal', 2 => 'Investigador', 1 => 'Administrador'], ['prompt' => '- Seleccionar -']) ?>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <?= $form->field($model, 'use_estado')->dropDownList([2 => 'Aprobado', 3 => 'Negado'], ['prompt' => '- Seleccionar -'])->label("Estado"); ?>
                        </div>
                        <div class="col-lg-2 col-sm-2">
                            <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
                            <!-- <a href="<?php //echo Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a> -->
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
                
                <?php 
                } // Fin de otros usuarios, distintos de administrador
                ?>
                
                
                
            </div>
        </section>
    </div> 
<?php
/*
$this->registerJs("    
    document.getElementById('user-use_estado').hidden=true;
    $(document).ready(function() {    
    $('#user-rol_id').click(function(event) {
    if ($('#user-rol_id').val() == 2) {
        document.getElementById('user-use_estado').hidden=false;
    } else {
        document.getElementById('user-use_estado').hidden=true;
    }        
     });
   });

 
   ");
 
 */
?>





</div>
</section>
<!-- End Bod Page Section -->
</div>
</main>
