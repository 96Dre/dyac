<?php

use kartik\date\DatePicker;
use unclead\multipleinput\TabularInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use backend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\coleccion\Coleccion */
/* @var $form yii\widgets\ActiveForm */
/* @var $coleccionpais frontend\models\coleccionpais\Coleccionpais */
/* @var $palabraclave frontend\models\palabraclave\Palabraclave */
/* @var $coleccionpersona frontend\models\coleccionpersona\Coleccionpersona */
/* @var $atributosExtra backend\models\atributoextra\Atributoextra */
/* @var $disciplina backend\models\disciplina\Disciplina */
/* @var $pais backend\models\pais\Pais */
/* @var $atrExtra frontend\models\coleccionatributoex\Coleccionatributoex */
/* @var $colaborador */
?>

<?php $this->registerJs("    
    
    $(document).ready(function() {
    $('.multiple-input-list__btn').hide();
 });
   "); ?>


<div class="coleccion-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= Html::label('Portada'); ?>
    <?= '<br>' ?>
    <center>
        <?= Html::img(Url::to(Url::base() . '/img/coleccion/' . $model->col_portada), ['width' => '150', 'height' => '150']) ?>
    </center>


    <?= $form->field($model, 'col_titulo')->textInput(['maxlength' => true, 'disabled' => true]) ?>

    <?= $form->field($model, 'col_descripcion')->textArea(['maxlength' => true, 'rows' => '6', 'disabled' => true]) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'dis_id')->dropDownList($disciplina, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>
        </div>
        <div class="col-md-6">
            <?=
            $form->field($model, 'col_fechaPublicacion')->widget(DatePicker::classname(), [
                'name' => 'dp_1',
                'disabled' => true,
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
                    'disabled' => true,
                ],
            ],
                [
                'name' => 'cpa_ubicacion',
                'title' => 'Ubicación',
                'enableError' => true,
                'options' => [
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                    'disabled' => true,
                ]
            ],
        ],
    ]);
    ?>


    <?= $form->field($model, 'col_fuente')->textInput(['maxlength' => true, 'disabled' => true]) ?>



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
                    'disabled' => true,
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
                'title' => 'Atributo Extra',
                'items' => $atributosExtra,
                'options' => [
                    'prompt' => '- Seleccionar -',
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                    'disabled' => true,
                ],
            ],
                [
                'name' => 'cae_descripcion',
                'title' => 'Descripción',
                'enableError' => true,
                'options' => [
                    'allowEmptyList' => false,
                    'enableGuessTitle' => true,
                    'disabled' => true,
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
                    'disabled' => true,
                ],
            ],
        ],
    ]);
    ?>

    <?= $form->field($model, 'col_estadocol')->dropDownList(['P' => 'Pendiente', 'A' => 'Aprobado', 'N' => 'Negado', 'B' => 'Bloqueado'], ['prompt' => '- Seleccionar -']); ?>

    <?= $form->field($model, 'observacion')->textArea(['maxlength' => true, 'rows' => '6', 'disabled' => false])->label('Obervaciones') ?>

    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
