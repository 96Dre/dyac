<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\tipoarchivo\Tipoarchivo;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\archivoatributoex\ArchivoatributoexSearch */
/* @var $form yii\widgets\ActiveForm */

$Datos2 = \yii\helpers\ArrayHelper::map(Tipoarchivo::find()->all(),'tar_id', 'tar_tipo');
?>

<div class="archivoatributoex-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //echo $form->field($model, 'aae_id') ?>

    <?php //echo $form->field($model, 'aex_id') ?>

    <?= $form->field($model, 'tar_id') ->dropDownList($Datos2, ['prompt' => '- Buscar en todo -' ]);?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-secondary']) ?>
        <?php // echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-repeat"></span> Reiniciar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
