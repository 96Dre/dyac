<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use yii\helpers\Url;
use yii\widgets\Pjax;
use unclead\multipleinput\TabularInput;

//use kartik\date\DatePicker;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\archivo\Archivo */
/* @var $form yii\widgets\ActiveForm */
/* @var $idioma backend\models\idioma\Idioma */
/* @var $genero backend\models\genero\Genero */
/* @var $pais backend\models\pais\Pais */
/* @var $derecho backend\models\derecho\Derecho */
/* @var $tipoArchivo backend\models\tipoarchivo\Tipoarchivo */
?>

<div class="archivo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // $form->field($model, 'arc_archivo')->fileInput(['options' => ['extensions'=>'jpg']]) ?>

    <?= $form->field($model, 'arc_archivo')->textInput(['autofocus' => true])->label('URL') ?>

    <a href="<?= Url::to(['create']) ?>" class="btn btn-secondary"><i class="bx bx-cloud-upload"></i> Prefiero subir archivo</a>

    <?= $form->field($model, 'arc_descripcion')->textArea(['maxlength' => true, 'rows' => '6']) ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'idi_id')->dropDownList($idioma, ['prompt' => '- Seleccionar -']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'gen_id')->dropDownList($genero, ['prompt' => '- Seleccionar -']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'pai_id')->dropDownList($pais, ['prompt' => '- Seleccionar -']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'arc_ubicacion')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'arc_cita')->textArea(['maxlength' => true, 'rows' => '6']) ?>

    <?= $form->field($model, 'der_id')->dropDownList($derecho, ['prompt' => '- Seleccionar -']) ?>

    <?php
    if ($tipo == 1) {
        echo TabularInput::widget([
            'models' => $atributoExtra,
            'min' => 1,
            'max' => 25,
            'columns' => [
                    [
                    'name' => 'aex_id',
                    'type' => 'dropDownList',
                    'title' => 'Atributo',
                    'items' => $ae,
                    'options' => [
                        'prompt' => '- Seleccionar -',
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                    ],
                ],
                    [
                    'name' => 'aex_descripcion',
                    'title' => 'Descripción',
                    'enableError' => true,
                    'options' => [
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                    ]
                ],
            ],
        ]);
    } else {


        echo TabularInput::widget([
            'models' => $detalleAE,
            'min' => 1,
            'max' => 25,
            'columns' => [
                    [
                    'name' => 'aex_id',
                    'type' => 'dropDownList',
                    'title' => 'Atributo',
                    'items' => $ae,
                    'options' => [
                        'prompt' => '- Seleccionar -',
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                    ],
                ],
                    [
                    //'models' => $detalleAE ,
                    'name' => 'dae_descripcion',
                    'title' => 'Descripción',
                    'enableError' => true,
                    'options' => [
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                    ]
                ],
            ],
        ]);
    }
    ?>


    <?php
    //if ($model->col_estadocol == ''){
    echo $form->field($model, 'arc_estadoarc')->hiddenInput(['value' => 'P'])->label(false);
    //}
    ?>


    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
