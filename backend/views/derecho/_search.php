<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\derecho\DerechoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="derecho-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'der_id') ?>

    <?= $form->field($model, 'der_nombre') ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-secondary']) ?>
        <?php // echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-repeat"></span> Reiniciar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
