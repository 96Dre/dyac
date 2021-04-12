<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use unclead\multipleinput\TabularInput;
use backend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\archivo\Archivo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="archivo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php // $form->field($model, 'arc_archivo')->fileInput() ?>

    <?= $form->field($model, 'arc_descripcion')->textArea(['maxlength' => true, 'rows' => '6', 'disabled' => true]) ?>


    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'idi_id')->dropDownList($idioma, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'gen_id')->dropDownList($genero, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'pai_id')->dropDownList($pais, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'arc_ubicacion')->textInput(['maxlength' => true, 'disabled' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'arc_cita')->textArea(['maxlength' => true, 'rows' => '6', 'disabled' => true]) ?>

    <?= $form->field($model, 'der_id')->dropDownList($derecho, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>

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
                        'disabled' => true,
                    ],
                ],
                    [
                    'name' => 'aex_descripcion',
                    'title' => 'Descripción',
                    'enableError' => true,
                    'options' => [
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                        'disabled' => true,
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
                        'disabled' => true,
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
                        'disabled' => true,
                    ]
                ],
            ],
        ]);
    }
    ?>

    <?= $form->field($model, 'arc_estadoarc')->dropDownList(['P' => 'Pendiente', 'A' => 'Aprobado', 'N' => 'Negado', 'B' => 'Bloqueado'], ['prompt' => '- Seleccionar -']); ?>

    <?= $form->field($model, 'observacion')->textArea(['maxlength' => true, 'rows' => '6', 'disabled' => false])->label('Obervaciones') ?>


    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
