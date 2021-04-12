<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\models\menu\Menu;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\menu\Menu */
/* @var $form yii\widgets\ActiveForm */

$padreMenu  = \yii\helpers\ArrayHelper::map(Menu::find()->where(['men_idPadre'=>0])->orderBy('men_id')->all(),'men_id', 'men_nombre');

?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::label('<h4> Si va a agregar una Padre, llene solo el Nombre y seleccione la opción deseada del campo "Activo" </h4>') ?>

    <br>
    <br>

    <?= $form->field($model, 'men_nombre')->textInput(['maxlength' => true])?>

    <?= $form->field($model, 'men_descripción')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'men_icono')->textInput(['maxlength' => true]) ->label('Icono. Visitar: ' . Html::a('Iconos', 'https://themesbrand.com/skote-mvc/layouts/icons-boxicons.html',['target'=>'_blank'])) ?>

    <?= $form->field($model, 'men_color')->dropDownList(['pink'=>'Rosa','cyan'=>'Cyan','green'=>'Verde','blue'=>'Azul'], ['prompt' => '- Seleccionar -' ]) ?>

    <?= $form->field($model, 'men_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'men_idPadre')->dropDownList($padreMenu, ['prompt' => '- Seleccionar -' ]) ?>

    <?= $form->field($model, 'men_activo')->dropDownList(['1'=>'Si','2'=>'No'], ['prompt' => '- Seleccionar -' ]) ?>


    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
