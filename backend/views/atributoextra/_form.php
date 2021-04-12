<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\atributoextra\Atributoextra */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="atributoextra-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'aex_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aex_descripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aex_tipo')->dropDownList([ 'Colección' => 'Colección', 'Archivo' => 'Archivo', ], ['prompt' => '- Seleccionar -' ]) ?>


    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
