<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\coleccion\ColeccionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coleccion-search">

    <?php $form = ActiveForm::begin([
        'action' => ['pendientes'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'col_titulo') ?>


    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-secondary']) ?>
        <?php // echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        <a href="<?= Url::to(['pendientes'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-repeat"></span> Reiniciar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
