<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\AppAsset;
use yii\helpers\Url;
use yii\widgets\Pjax;
use unclead\multipleinput\TabularInput;
use backend\models\tipoarchivo\Tipoarchivo;

//use kartik\date\DatePicker;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model frontend\models\archivo\Archivo */
/* @var $form yii\widgets\ActiveForm */
/* @var $idioma backend\models\idioma\Idioma */
/* @var $genero backend\models\genero\Genero */
/* @var $pais backend\models\pais\Pais */
/* @var $derecho backend\models\derecho\Derecho */
/* @var $tipoArchivo backend\models\tipoarchivo\Tipoarchivo */

$session = Yii::$app->session;
if (isset($session['tipo_archivo_seleccionado'])) {
    $tipo_de_archivo_seleccionado = $session['tipo_archivo_seleccionado'];
}
?>

<style>
    #WindowLoad
    {
        position:fixed;
        top:0px;
        left:0px;
        z-index:3200;
        filter:alpha(opacity=65);
        -moz-opacity:65;
        opacity:0.65;
        background:#999;
    }
</style>
<script>
    function jsRemoveWindowLoad() {
        // eliminamos el div que bloquea pantalla
        $("#WindowLoad").remove();

    }

    function jsShowWindowLoad(mensaje) {
        //eliminamos si existe un div ya bloqueando
        jsRemoveWindowLoad();

        //si no enviamos mensaje se pondra este por defecto
        if (mensaje === undefined)
            mensaje = "Procesando la información<br>Espere por favor";

        //centrar imagen gif
        height = 20;//El div del titulo, para que se vea mas arriba (H)
        var ancho = 0;
        var alto = 0;

        //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
        if (window.innerWidth == undefined)
            ancho = window.screen.width;
        else
            ancho = window.innerWidth;
        if (window.innerHeight == undefined)
            alto = window.screen.height;
        else
            alto = window.innerHeight;

        //operación necesaria para centrar el div que muestra el mensaje
        var heightdivsito = alto / 2 - parseInt(height) / 2;//Se utiliza en el margen superior, para centrar

        //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
        imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div><img src='<?= Url::base() ?>/img/iconos/load.gif'></div>";

        //creamos el div que bloquea grande------------------------------------------
        div = document.createElement("div");
        div.id = "WindowLoad"
        div.style.width = ancho + "px";
        div.style.height = alto + "px";
        $("body").append(div);

        //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
        // input = document.createElement("input");
        // input.id = "focusInput";
        // input.type = "text"

        //asignamos el div que bloquea
        // $("#WindowLoad").append(input);

        //asignamos el foco y ocultamos el input text
        //$("#focusInput").focus();
        //$("#focusInput").hide();

        //centramos el div del texto
        $("#WindowLoad").html(imgCentro);

    }
</script>



<div class="archivo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php /* if ($model->tar_id == 2 || $model->tar_id == 3) { // Si es audio o video  entonces subir la URL ?>
      <?= $form->field($model, 'arc_archivo')->textInput(['autofocus' => true])->label('URL') ?>
      <?php } else { // Si no es audio o video  entonces subir el archivo  ?>
      <?= $form->field($model, 'arc_archivo')->fileInput(['options' => ['extensions' => 'jpg']]) ?>
      <?php
      } // Fin de subir archivos
     */
    ?>

    <?= $form->field($model, 'arc_archivo')->textInput(['autofocus' => true])->label('URL') ?>



    <a href="<?= Url::to(['update?id='.$model->arc_id])  ?>" class="btn btn-secondary"><i class="bx bx-link"></i> Prefiero subir un archivo</a>

    <?= $form->field($model, 'arc_descripcion')->textArea(['maxlength' => true, 'rows' => '6']) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'idi_id')->dropDownList($idioma, ['prompt' => '- Seleccionar -']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'gen_id')->dropDownList($genero, ['prompt' => '- Seleccionar -']) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'pai_id')->dropDownList($pais, ['prompt' => '- Seleccionar -']) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'arc_ubicacion')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?= $form->field($model, 'arc_cita')->textArea(['maxlength' => true, 'rows' => '6']) ?>

    <?= $form->field($model, 'der_id')->dropDownList($derecho, ['prompt' => '- Seleccionar -'])->label('Nivel de acceso') ?>

    <?php
    if ($tipo == 1) {
        echo TabularInput::widget([
            'models' => $atributoExtra,
            'min' => 1,
            'max' => 25,
            'columns' => [
                    [
                    'name' => 'aex_id',
                    'type' => 'dropDownList',
                    'title' => 'Atributo',
                    'items' => $ae,
                    'options' => [
                        'prompt' => '- Seleccionar -',
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                    ],
                ],
                    [
                    'name' => 'aex_descripcion',
                    'title' => 'Descripción',
                    'enableError' => true,
                    'options' => [
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                    ]
                ],
            ],
        ]);
    } else {


        echo TabularInput::widget([
            'models' => $detalleAE,
            'min' => 1,
            'max' => 25,
            'columns' => [
                    [
                    'name' => 'aex_id',
                    'type' => 'dropDownList',
                    'title' => 'Atributo',
                    'items' => $ae,
                    'options' => [
                        'prompt' => '- Seleccionar -',
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                    ],
                ],
                    [
                    //'models' => $detalleAE ,
                    'name' => 'dae_descripcion',
                    'title' => 'Descripción',
                    'enableError' => true,
                    'options' => [
                        'allowEmptyList' => false,
                        'enableGuessTitle' => true,
                    ]
                ],
            ],
        ]);
    }
    ?>


    <?php
//if ($model->col_estadocol == ''){
    echo $form->field($model, 'arc_estadoarc')->hiddenInput(['value' => 'P'])->label(false);
//}
    ?>


    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
