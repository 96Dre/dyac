<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\assets\AppAsset;
use unclead\multipleinput\TabularInput;


AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model backend\models\tipoarchivo\Tipoarchivo */
/* @var $modelAtributos backend\models\atributoextra\atributoExtra */
/* @var $atributosExtra backend\models\archivoatributoex\Archivoatributoex */

?>

<div class="tipoarchivo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tar_tipo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tar_extension')->textInput(['maxlength' => true]) ?>

    <br><h5>Seleccione los atributos extra:</h5>

    <?php
/*
    echo TabularInput::widget([
        'models' => $tipoExt,
        'min' => 1,
        'max' => 10,
        'columns' => [
            [
                'name' => 'tae_extension',
                'title' => 'Extensión',
                'enableError' => true,
                'options' => [
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                ]
            ],
        ],
    ]);*/

    if($model->tar_id == ''){
       
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            'aex_nombre',
            'aex_descripcion',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model) {
                    return ['value' => $model->aex_id];
                },
            ],
        ];
    }else{        
        $columns = [
            ['class' => 'yii\grid\SerialColumn'],
            'aex_nombre',
            'aex_descripcion',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model) use ($atributosExtra) {

                    foreach ($atributosExtra as $item){
                        if($model->aex_id == $item->aex_id){
                      //    if($model->aex_id){
                            return  ['checked' => true , 'value' => $model->aex_id];
                        }
                    }

                    return ['value' => $model->aex_id];
                },
            ],
        ];
    }


    echo GridView::widget([
        'dataProvider' => $modelAtributos,
        'columns' => $columns,
    ]);




    ?>




    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>

