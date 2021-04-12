<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\pais\Pais;
use yii\helpers\Url;
use backend\models\usergenero\Usergenero;
use backend\assets\AppAsset;

AppAsset::register($this);


/* @var $this yii\web\View */
/* @var $model backend\models\user\User */
/* @var $form yii\widgets\ActiveForm */

$pais = \yii\helpers\ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(), 'pai_id', 'pai_nombre');
$genero = \yii\helpers\ArrayHelper::map(Usergenero::find()->all(), 'uge_id', 'uge_nombre');
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">

        <div class="col-lg-6 col-md-6 col-sm-12">

            <?= $form->field($model, 'use_nombre')->textInput(['autofocus' => true, 'disabled' => false]) ?>

            <?= $form->field($model, 'use_apellido')->textInput(['disabled' => false]) ?>

            <?= $form->field($model, 'uge_id')->dropDownList($genero, ['prompt' => '- Seleccionar -', 'disabled' => false]); ?>

            <?= $form->field($model, 'pai_id')->textInput()->dropDownList($pais, ['prompt' => '- Seleccionar -', 'disabled' => false]); ?>

            <?= $form->field($model, 'use_telefono')->textInput(['disabled' => false]) ?>

            <?php // $form->field($model, 'use_foto')->fileInput()  ?>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <?=
            "<center>" . Html::img('@web/img/user/' . $model->use_foto, ['alt' => 'Foto de usuario',
                'width' => '15%']) . "</center>";
            ?>
            <center><?= $model->email ?></center>

            <?php // $form->field($model, 'password')->passwordInput()  ?>

            <?php // $form->field($model, 'repeat_password')->passwordInput()  ?>

            <?= $form->field($model, 'rol_id')->dropDownList([3 => 'Normal', 2 => 'Investigador', 1 => 'Administrador'], ['prompt' => '- Seleccionar -']) ?>

            <?php
            if ($model->rol_id == 2) {
                echo $form->field($model, 'use_estado')->dropDownList([2 => 'Aprobado', 3 => 'Negado'], ['prompt' => '- Seleccionar -']);
            } else {
                echo $form->field($model, 'use_estado')->hiddenInput(['value' => 1])->label(false);
            }
            ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
                <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
