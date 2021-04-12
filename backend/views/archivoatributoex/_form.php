<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\atributoextra\Atributoextra;
use backend\models\tipoarchivo\Tipoarchivo;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\archivoatributoex\Archivoatributoex */
/* @var $form yii\widgets\ActiveForm */

$Datos1 = \yii\helpers\ArrayHelper::map(Atributoextra::find()->where(['aex_tipo'=>'Archivo'])->all(),'aex_id', 'aex_nombre');
$Datos2 = \yii\helpers\ArrayHelper::map(Tipoarchivo::find()->all(),'tar_id', 'tar_tipo');

//debemos rescatar la variable para que carge con el Tipo archivo y mostrar en el combo


?>

<div class="archivoatributoex-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tar_id')->dropDownList($Datos2, ['prompt' => '- Seleccionar -','disabled' => true ]); ?>

    <?= $form->field($model, 'aex_id')->dropDownList($Datos1, ['prompt' => '- Seleccionar -' ]); ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
