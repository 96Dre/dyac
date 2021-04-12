<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\preguntafrecuente\PreguntaFrecuenteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pregunta-frecuente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'pfr_pregunta') ?>

    <?php // $form->field($model, 'pfr_respuesta') ?>

   

    <?php // echo $form->field($model, 'pfr_fechaAudit') ?>

    <?php // echo $form->field($model, 'pfr_accion') ?>

   <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-secondary']) ?>
        <?php // echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-repeat"></span> Reiniciar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
