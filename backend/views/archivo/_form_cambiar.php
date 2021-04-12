<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;
use unclead\multipleinput\TabularInput;
use backend\assets\AppAsset;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\archivo\Archivo */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $this->registerJs("    
    
    $(document).ready(function() {
    $('.multiple-input-list__btn').hide();
 });
   "); ?>


<div class="archivo-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <!-- ******************************************************* -->
    <!-- ******************************************************* -->
    <!-- ******************************************************* -->

    <?php
    if ($model->tar_id == 2) { // ***************** De tipo audio *****************
        $url_audio = $model->arc_archivo;
        //verificamos si es de youtube    https://www.youtube.com/watch?v=e6QcflIo3cY             
        $buscar = 'www.youtube.com';
        $pos = strpos($url_audio, $buscar);
        if ($pos !== false) {
            $url_modificado = str_replace("https://www.youtube.com/watch?v=", "", $url_audio);
        } else {  //verificamos si es de youtube music   https://music.youtube.com/watch?v=9h_vEGcDI_U&list=RDAMVM9h_vEGcDI_U
            $buscar = 'music.youtube.com';
            $pos = strpos($url_audio, $buscar);
            if ($pos !== false) {
                //1. Eliminar el inicio de la URL
                $url_musica = str_replace("https://music.youtube.com/watch?v=", "", $url_audio);
                //2. Buscar la posicion de &list
                $pos = strpos($url_musica, "&list=");
                //3. Copiar desde el inicio hasta la posición encontrada en el literal anterior
                $url_modificado = substr($url_musica, 0, $pos);
            } else {
                $url_modificado = $url_audio;
            }
        }
        ?>
        <center>
            <div data-video = "<?= $url_modificado ?>"
                 data-autoplay = "0"
                 data-loop = "1"
                 id = "youtube-audio">
            </div>
            <script src = "https://www.youtube.com/iframe_api"></script>
            <script src="https://cdn.rawgit.com/labnol/files/master/yt.js"></script>
        </center>

    <?php }; // ***************** Fin de tipo audio **************** ?>
    <?php
    if ($model->tar_id == 3) { // ***************** De tipo video  *****************                      
        $url_video = $model->arc_archivo;
        //verificamos si es de youtube                 
        $buscar = 'youtube';
        $pos = strpos($url_video, $buscar);
        if ($pos !== false) {
            $url_modificado = str_replace("watch?v=", "embed/", $url_video);
        } else {
            $url_modificado = $url_video;
        }
        ?>     
        <center>  <iframe width="50%"  
                          src="<?= $url_modificado ?>" 
                          frameborder="0" 
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                          allowfullscreen></iframe>
        </center>
    <?php } // ***************** Fin de tipo video ***************** ?>
    <?php
    if ($model->tar_id == 1) { // ***************** De tipo Imagen  *****************                        
        echo "<center>" . Html::img('../../../frontend/web/img/archivo/' . $model->arc_archivo, ['alt' => 'Imagen de archivo',
            'width' => '25%']) . "</center>";
    } // ***************** Fin de tipo imagen ***************** 
    ?>

    <?php
    $url_archivo = Url::to('../../../frontend/web/img/archivo/' . $model->arc_archivo);
    // Comprobar si existe un archivo
    $existe = file_exists($url_archivo);
    // if ($existe === true){
    //echo CHtml::  CHtml::link('Descargar',array($url_archivo));
    echo '<a href="' . $url_archivo . '">' . $model->arc_archivo . '</a>';
    //}
    ?>

    <!-- ******************************************************* -->
    <!-- ******************************************************* -->
    <!-- ******************************************************* -->


    <?php // $form->field($model, 'arc_archivo')->fileInput() ?>

    <?= $form->field($model, 'arc_descripcion')->textArea(['maxlength' => true, 'rows' => '6', 'disabled' => true]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'idi_id')->dropDownList($idioma, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'gen_id')->dropDownList($genero, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'pai_id')->dropDownList($pais, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'arc_ubicacion')->textInput(['maxlength' => true, 'disabled' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'arc_cita')->textArea(['maxlength' => true, 'rows' => '6', 'disabled' => true]) ?>

    <?= $form->field($model, 'der_id')->dropDownList($derecho, ['prompt' => '- Seleccionar -', 'disabled' => true]) ?>

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
                        'disabled' => true,
                    ],
                ],
                    [
                    'name' => 'aex_descripcion',
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
                        'disabled' => true,
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
                        'disabled' => true,
                    ]
                ],
            ],
        ]);
    }
    ?>

    <?= $form->field($model, 'arc_estadoarc')->dropDownList(['P' => 'Pendiente', 'A' => 'Aprobado', 'N' => 'Negado', 'B' => 'Bloqueado'], ['prompt' => '- Seleccionar -']); ?>

    <?= $form->field($model, 'observacion')->textArea(['maxlength' => true, 'rows' => '6', 'disabled' => false])->label('Obervaciones') ?>


    <div class="form-group">
        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Save'), ['class' => 'btn btn-secondary']) ?>
        <a href="<?= Url::to(['index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
    </div>

    <?php ActiveForm::end(); ?>

</div>
