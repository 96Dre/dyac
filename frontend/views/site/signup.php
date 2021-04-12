
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\pais\Pais;
use backend\models\usergenero\Usergenero;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

AppAsset::register($this);

$this->title = 'Registrarse';
//$this->params['breadcrumbs'][] = $this->title;

$pais = \yii\helpers\ArrayHelper::map(Pais::find()->orderBy('pai_nombre')->all(), 'pai_id', 'pai_nombre');
$genero = \yii\helpers\ArrayHelper::map(Usergenero::find()->all(), 'uge_id', 'uge_nombre');
?>
<head>        <link rel="stylesheet" type="text/css" href="<?= Url::base() ?>/captcha2021/estilo.css">
</head>
<main id="main">
    <!-- ======= Header Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

        </div>
    </section><!-- End Header Section -->
    <!-- ======= Body Section ======= -->
    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">

            

            <?php $form = ActiveForm::begin(['id' => 'form-signup', 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="col-lg-6 col-md-6">
                        <p>Por favor complete los siguientes campos para registrarse:</p>
                        <?= $form->field($model, 'use_nombre')->textInput(['autofocus' => true, 'placeholder'=>'Ingrese nombres'])->label('Nombre') ?>

                        <?= $form->field($model, 'use_apellido')->textInput(['placeholder'=>'Ingrese apellidos'])->label('Apellido') ?>

                        <?= $form->field($model, 'uge_id')->dropDownList($genero, ['prompt' => '- Seleccionar -'])->label('Sexo') ?>

                        <?php // $form->field($model, 'pai_id')->dropDownList($pais, ['prompt' => '- Seleccionar -'])->label('País') ?>




                        <?php
                        //para Pais

                        $var1 = ArrayHelper::map(Pais::find()->orderBy('pai_nombre asc')->all(), 'pai_id', 'pai_nombre');

                        echo $form->field($model, 'pai_id')->widget(Select2::classname(), [
                            'data' => $var1,
                            'language' => 'es',
                            'options' => ['placeholder' => 'Seleccionar ...'],
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                        ]);
                        //fin pais
                        ?>






                        <?= $form->field($model, 'use_telefono')->textInput(['placeholder'=>'Teléfono Ej. 022 453345'])->label('Teléfono') ?>

                    </div>

                    <div class="col-lg-6 col-md-6">
                        <?= $form->field($model, 'use_foto')->fileInput()->label('Foto') ?>

                        <?= $form->field($model, 'email')->textInput(['placeholder'=>'Ingrese el correo electrónico.']) ?>

                        <?= $form->field($model, 'repeat_email')->textInput(['placeholder'=>'Repita el correo electrónico.']) ?>

                        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Ingrese la contraseña'])->label('Contraseña') ?>

                        <?= $form->field($model, 'repeat_password')->passwordInput(['placeholder'=>'Repita la contraseña'])->label('Repetir Contraseña') ?>

                        <?= $form->field($model, 'rol_id')->dropDownList([3 => 'Normal', 2 => 'Investigador'], [])->label('Tipo de cuenta') ?>

                        <?= $form->field($model, 'use_estado')->hiddenInput(['value' => 1])->label(false) ?>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12">
                    <div id="Contenedor">    
                        <div class=" text-center">
                            <span class="text-primary h2"><strong><?= "Validar Captcha"; ?></strong></span>
                        </div>
                        <table>
                            <tr>
                                <td style="text-align: center;">
                                    <a href="javascript:void(0)"  class="btncapt">
                                        <img class="img-fluid"  src="<?= Url::base() ?>/img/refresh_1.png" width="30"/>
                                        <!--<span class="glyphicon glyphicon-refresh" aria-hidden="false"></span>-->
                                        Recargar código</a>
                                </td>
                                <td style="width: 80%; text-align: center;">
                                    <canvas id="capatcha"  style="width:320px;  border: 1px solid #ccc; float:left; " height="62"></canvas>                   
                                </td>    
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="div_mensaje"></div>
                                    <input type="text" name="contra" id="valorCapt" class="form-control" placeholder="Código de seguridad" aria-describedby="sizing-addon1" required>
                                </td>                                                
                            </tr>
                        </table>
                        <br>
                        <!--<button class="btn btn-lg btn-primary btn-block btn-signin" id="IngresoLog" type="button">Validar</button>-->
                        <br>    
                    </div>


                    <!--                INICIO - Términos de uso y politicas de privacidad-->

                    <div id="accordion">                       
                        <div class="">
                            <div class="badge-light" id="headingThree">

                                <label class="text-justify">
                                    <input type="checkbox" id="cbTerminos" value="">
                                    Acepto los  
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Términos de Uso 
                                    </button>
                                    y doy mi consentimiento 
                                    a que se procese mi información personal de acuerdo a 
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseDos" aria-expanded="false" aria-controls="collapseThree">
                                        la Política de Privacidad. 
                                    </button>
                                    Comprendo que mi dirección de 
                                    correo electrónico se agregará a la lista de correos de DYAC.
                                </label>
                            </div>                            
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body text-justify">
                                    <h2>Términos de Uso </h2>at skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. BrunAnim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>
                            <div id="collapseDos" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body text-justify">
                                    <h2>Política de Privacidad </h2> at skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. BrunAnim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--                FIN - Términos de uso y politicas de privacidad-->      



                    <div class="form-group text-center">
                        <?=
                        Html::submitButton('Registrarse', ['id' => "IngresoLog",
                            'class' => 'btn btn-primary',
                            'name' => 'signup-button'])
                        ?>
                        <a href="<?= Url::to(['site/index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Cancelar</a>
                    </div>

                </div>
            </div>




        </div>
        <?php ActiveForm::end(); ?>

        <div style="color:#999;margin:1em 0">
            ¿Ya tiene una cuenta? <?= Html::a('Inicie sesión.', ['site/login']) ?>
        </div>

        </div>
    </section>
    <!-- ======= End Body Section ======= -->
</main><!-- End #main -->

<?php $this->registerJs("    
    var banderaCaptcha = false;
    $(document).ready(function() {
    document.getElementById('IngresoLog').disabled=true;
    var isChecked = document.getElementById('cbTerminos');
    $('#cbTerminos').change(function(event) {      
    if (banderaCaptcha == true && isChecked.checked == true) {
     document.getElementById('IngresoLog').disabled=false;    
     } else {
          document.getElementById('IngresoLog').disabled=true;    
    }
      });
 });
   "); ?>



<?php $this->registerJs("    
    
    $(document).ready(function() {
    document.getElementById('IngresoLog').disabled=true;
       var isChecked = document.getElementById('cbTerminos');
    $('#valorCapt').keyup(function(event) {
      //event.preventDefault();
      //Se envia peticion Ajax
      //al servidor para verificar
      //si la clave introducida es la
      //correcta, y nos nuestra en un alert
      $.ajax({
        url: '" . Url::base() . "/captcha2021/VerifCaptha.php',
        type: 'POST',
        dataType: 'text',
        data: {'valor': $('#valorCapt').val()},
      })
      .done(function(data) {
       // alert(data);
       if (data === 'Captcha Incorrecta'){
       $('#div_mensaje').html('<div class=\"text-warning h3\">'+data+'</div>'); 
       document.getElementById('IngresoLog').disabled=true;
       banderaCaptcha = false;
       } else {
            banderaCaptcha = true;
            $('#div_mensaje').html('<div class=\"text-success h3\">'+data+'</div>'); 
            if (isChecked.checked == true) {
                document.getElementById('IngresoLog').disabled=false;
                };
           
            }
      })
      .fail(function() {
        //console.log('error');
      })
      .always(function() {
        //console.log('complete');
      });
      
      });
//Reccarga al hacer clik en el 
//boton par generar nuevo clave
 $('.btncapt').click(function(event) {
    CargarCaptcha();
 });

 CargarCaptcha();
});

/**
 * Realiza la peticion AJAX
 * al servidor para generar clave
 */
function CargarCaptcha() {
   $.ajax({
    url: '" . Url::base() . "/captcha2021/captcha2.php',
    type: 'post',
    dataType: 'text',
    data:{'capt':'visto'}
   })
   .done(function(data) {
   // alert(data);
    var visto=$.parseJSON(data);
    //Dibujamos en el CANVA las claves 
    //devueltas por el servidor
    var canva=document.getElementById('capatcha');
    var dibujar=canva.getContext('2d');
    canva.width = canva.width;
    dibujar.fillStyle='red';
    dibujar.font='20pt \"NeoPrint M319\"';
    dibujar.fillText(visto.retornar,6,39);
    //console.log(data);
   })
   .fail(function() {
    //console.log('error');
   })
   .always(function() {
    //console.log('complete');
   });
}  
 
   "); ?>


