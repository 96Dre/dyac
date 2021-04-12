<?php 
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use frontend\assets\AppAsset;
?>
<head>        <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/captcha2021/estilo.css">
</head>
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

AppAsset::register($this);

$this->title = 'Reenviar mensaje de verificación';
//$this->params['breadcrumbs'][] = $this->title;
?>
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

            <p>Ingrese su email. Se enviará nuevamente el enlace de verificación de la cuenta.</p>

            <div class="row">
                <div class="col-lg-6">
                    <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    
                    
                    
                    <div id="Contenedor">    
                        <div class=" text-center">
                            <span class="text-primary h2"><strong><?= "Validar Captcha"; ?></strong></span>
                        </div>
                        <table>
                            <tr>
                                <td style="text-align: center;">
                                    <a href="javascript:void(0)"  class="btncapt">
                                        <img class="img-fluid"  src="<?=Url::base()?>/img/refresh_1.png" width="30"/>
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
                    
                    
                    
                    
                    
                    
                    <div class="form-group">
                        <?= Html::submitButton('Enviar', 
                                ['id' => "IngresoLog",'class' => 'btn btn-primary']) ?>
                        <a href="<?= Url::to(['site/index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Cancelar</a>

                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </section>
    <!-- ======= End Body Section ======= -->
</main><!-- End #main -->





<?php $this->registerJs("    
    
    $(document).ready(function() {
    document.getElementById('IngresoLog').disabled=true;
    $('#valorCapt').keyup(function(event) {
      //event.preventDefault();
      //Se envia peticion Ajax
      //al servidor para verificar
      //si la clave introducida es la
      //correcta, y nos nuestra en un alert
      $.ajax({
        url: '".Url::base()."/captcha2021/VerifCaptha.php',
        type: 'POST',
        dataType: 'text',
        data: {'valor': $('#valorCapt').val()},
      })
      .done(function(data) {
       // alert(data);
       if (data === 'Captcha Incorrecta'){
       $('#div_mensaje').html('<div class=\"text-warning h3\">'+data+'</div>'); 
       document.getElementById('IngresoLog').disabled=true;
       } else {
            $('#div_mensaje').html('<div class=\"text-success h3\">'+data+'</div>'); 
            document.getElementById('IngresoLog').disabled=false;
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
    url: '".Url::base()."/captcha2021/captcha2.php',
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


