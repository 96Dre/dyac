<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\archivo\ArchivoSearch */
/* @var $form yii\widgets\ActiveForm */

$Datos2 = \yii\helpers\ArrayHelper::map(\backend\models\tipoarchivo\Tipoarchivo::find()->all(),'tar_id', 'tar_tipo');
?>

<div class="archivo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>



    <?= $form->field($model, 'tar_id') ->dropDownList($Datos2, ['prompt' => '- Buscar en todo -' ]);?>



    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-search"></span> ' . Yii::t('app', 'Search'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-repeat"></span> Reiniciar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
