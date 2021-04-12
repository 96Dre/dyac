<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use frontend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\user\User */
/* @var $modelInvestigador frontend\models\investigador\Investigador */
/* @var $form yii\widgets\ActiveForm */
/* @var $pais backend\models\pais\Pais */
/* @var $genero backend\models\genero\Genero */

?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="row">


            <div class="col-lg-12">
                <img class="mx-auto d-block rounded-circle"  src="<?= Url::to(Url::base().'/../../backend/web/img/user/' . $model->use_foto) ?>" width="200" height="205">
            </div>



        <div class="col-lg-12">

            <br>

<?php /* ?>
            <?= Html::tag('h3', '- Información Personal -', ['align'=>'center']) ?>

            <?= $form->field($model, 'use_nombre')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'use_apellido')->textInput() ?>

            <?= $form->field($model, 'uge_id')->dropDownList($genero, ['prompt' => '- Seleccionar -' ]);?>

            <?= $form->field($model, 'pai_id')->textInput() ->dropDownList($pais, ['prompt' => '- Seleccionar -' ]);?>

            <?= $form->field($model, 'use_telefono')->textInput() ?>

            <?= $form->field($model, 'use_foto')->fileInput() ?>
<?php */ ?>
       <!-- </div>


        <div class="col-lg-6"> -->
            <?php
            if ($model->rol_id == 2 && $model->use_estado == 2){ ?>
<?php /* ?>
       
                <?= Html::tag('h3', '- Perfil de Investigador -', ['align'=>'center']) ?>

                <?= $form->field($modelInvestigador, 'usu_id')->hiddenInput(['value'=>Yii::$app->user->identity->id])->label(false) ?>

                <?= $form->field($modelInvestigador, 'inv_tituloProfesional')->textInput(['maxlength' => true]) ?>

                <?= $form->field($modelInvestigador, 'inv_descripcion')->textInput(['maxlength' => true]) ?>

                <?= $form->field($modelInvestigador, 'inv_twitter')->textInput(['maxlength' => true]) ?>

                <?= $form->field($modelInvestigador, 'inv_facebook')->textInput(['maxlength' => true]) ?>

                <?= $form->field($modelInvestigador, 'inv_instagram')->textInput(['maxlength' => true]) ?>

                <?= $form->field($modelInvestigador, 'inv_web')->textInput(['maxlength' => true]) ?>
<?php */ ?>
            <?php } ?>

            <!-- </div>


              <div class="col-lg-6"> -->
<?php /* ?>
                <?= Html::tag('h3', '- Información de la cuenta -', ['align'=>'center']) ?>

                <?= $form->field($model, 'email') ?>
<?php */ ?>
                 <?= Html::tag('h5', '- Cambiar contraseña -', ['align'=>'center']) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'repeat_password')->passwordInput() ?>

                <?php
                if($model->rol_id == 3){
                        echo $form->field($model, 'rol_id')->dropDownList(['2'=>'Si','3'=>'No'], ['prompt' => '- Seleccionar -' ])->label('¿Desea un perfil de investigador?');

                }
//                if ($model->rol_id == 2 && $model->use_estado == 1){
//                    echo "<h5 class='alert alert-success alert-dismissable'> Se esta procesando su solicitud para Investigador.</h5>";
//                }
                if ($model->rol_id == 2 && $model->use_estado == 3){
                    echo "<h5> Su solicitud para investigador fue rechazada.</h5>";
                    echo $form->field($model, 'use_estado')->dropDownList([3 => 'No', 1 => 'Si'])->label('¿Desea volver a enviar una solicitud?') ;
                }
                ?>

        </div>


        <div class="form-group col-lg-6">
            <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
            <a href="<?= Url::base()?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
        </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
