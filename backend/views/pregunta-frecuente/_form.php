<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\preguntafrecuente\PreguntaFrecuente */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pregunta-frecuente-form">

    <?php $form = ActiveForm::begin(); ?>    
    <?= $form->field($model, 'pfr_pregunta')->textArea(['maxlength' => true, 'rows' => '1'])?>
    <?= $form->field($model, 'pfr_respuesta')->textArea(['maxlength' => true, 'rows' => '6'])?>    

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>
   

    <?php ActiveForm::end(); ?>

</div>
