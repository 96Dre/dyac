<?php

use kartik\date\DatePicker;
use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\coleccion\Coleccion */
/* @var $coleccionpais frontend\models\coleccionpais\Coleccionpais */
/* @var $palabraclave frontend\models\palabraclave\Palabraclave */
/* @var $coleccionpersona frontend\models\coleccionpersona\Coleccionpersona */
/* @var $atributosExtra backend\models\atributoextra\Atributoextra */
/* @var $disciplina backend\models\disciplina\Disciplina */
/* @var $pais backend\models\pais\Pais */
/* @var $atrExtra frontend\models\coleccionatributoex\Coleccionatributoex */
/* @var $colaborador */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coleccion-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'col_titulo')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'col_descripcion')->textArea(['maxlength' => true, 'rows' => '6']) ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'dis_id')->dropDownList($disciplina, ['prompt' => '- Seleccionar -']) ?>
        </div>
        <div class="col-sm-6">
            <?=
            $form->field($model, 'col_fechaPublicacion')->widget(DatePicker::classname(), [
                'name' => 'dp_1',
                'type' => DatePicker::TYPE_COMPONENT_PREPEND,
                'value' => '',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]);
            ?>
        </div>
    </div>

    <?=
    TabularInput::widget([
        'models' => $coleccionpais,
        'min' => 1,
        'max' => 10,
        'columns' => [
                [
                'name' => 'pai_id',
                'type' => 'dropDownList',
                'title' => 'País',
                'items' => $pais,
                'options' => [
                    'prompt' => '- Seleccionar -',
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                ],
            ],
                [
                'name' => 'cpa_ubicacion',
                'title' => 'Ubicación',
                'enableError' => true,
                'options' => [
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                ]
            ],
        ],
    ]);
    ?>


    <?= $form->field($model, 'col_fuente')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'col_portada')->fileInput() ?>

    <?=
    TabularInput::widget([
        'models' => $palabraclave,
        'min' => 0,
        'max' => 10,
        'columns' => [
                [
                'name' => 'pcl_palabraClave',
                'title' => 'Palabra clave',
                'enableError' => true,
                'options' => [
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                ]
            ],
        ],
    ]);
    ?>

    <?=
    TabularInput::widget([
        'models' => $atrExtra,
        'min' => 0,
        'max' => 10,
        'columns' => [
                [
                'name' => 'aex_id',
                'type' => 'dropDownList',
                'title' => 'Atributo',
                'items' => $atributosExtra,
                'options' => [
                    'prompt' => '- Seleccionar -',
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                ],
            ],
                [
                'name' => 'cae_descripcion',
                'title' => 'Descripción',
                'enableError' => true,
                'options' => [
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                ]
            ],
        ],
    ]);
    ?>

    <?=
    TabularInput::widget([
        'models' => $coleccionpersona,
        'min' => 0,
        'max' => 10,
        'columns' => [
                [
                'name' => 'inv_id',
                'type' => 'dropDownList',
                'title' => 'Colaborador/es',
                'items' => $colaborador,
                'options' => [
                    'prompt' => '- Seleccionar -',
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                ],
            ],
        ],
    ]);
    ?>

<?php
//if ($model->col_estadocol == ''){
echo $form->field($model, 'col_estadocol')->hiddenInput(['value' => 'P'])->label(false);
//}
?>
<?= $form->field($model, 'col_estado')->hiddenInput(['value' => 'N'])->label(false) ?>



    <div class="form-group">
<?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

<?php ActiveForm::end(); ?>

</div>


