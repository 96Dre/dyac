
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\assets\AppAsset;

use yii\helpers\Url;

AppAsset::register($this);

$this->title = 'Contacto';

?>
<head>        <link rel="stylesheet" type="text/css" href="<?=Url::base()?>/captcha2021/estilo.css">
</head>
<?php if (Yii::$app->session->hasFlash('success')) { ?>
    <div class="alert alert-success alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>Enhorabuena!</h4>
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php } ?>

<main id="main">
    <!-- ======= Contact Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

        </div>
    </section><!-- End Contact Section -->

    <!-- ======= Contact Section ======= -->
    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box">
                                <i class="bx bx-map"></i>
                                <h3>Dirección</h3>
                                <p>Av. 24 de Mayo 7-77 y Hernán Malo</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bx bx-envelope"></i>
                                <h3>Direcciones de correo</h3>
                                <p> dyac@uazuay.edu.ec</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box">
                                <i class="bx bx-phone-call"></i>
                                <h3>Teléfono</h3>
                                <p>(593) 7 4091000</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <!--<form action="forms/contact.php" method="post" role="form" class="php-email-form">-->
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                             <!--<input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />-->
                            <?= $form->field($model, 'name')->textInput(['autofocus' => true])->label('Nombre y Apellido') ?>
                            <!--<div class="validate"></div>-->
                            <!--<input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />-->
                            <?= $form->field($model, 'email')->label('Email') ?>
                            <!--<div class="validate"></div>-->
                      <div class="form-group">
                        <!--<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />-->
                        <?= $form->field($model, 'subject')->label('Asunto') ?>
                        <div class="validate"></div>
                    </div>
                    <div class="form-group">
                        <!--<textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>-->
                        <?= $form->field($model, 'body')->textarea(['rows' => 6])->label('Mensaje') ?>
                        <div class="validate"></div>
                    </div>



                    <div id="Sin_Contenedor">  
                        <div class=" text-center">
                            <span class="text-primary h2"><strong><?= "Validar Captcha"; ?></strong></span>
                        </div>
                        <table>
                            <tr>
                                <td style="text-align: center;">
                                    <a href="javascript:void(0)"  class="btncapt">
                                        <!--<span class="glyphicon glyphicon-refresh" aria-hidden="false"></span>--> 
                                        <img class="img-fluid"  src="<?=Url::base()?>/img/refresh_1.png" width="30"/>
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
                    </div>



                    <div class="mb-3">
                        <!--<div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div> -->
                    </div>
                    <!--<div class="text-center"><button type="submit">Send Message</button></div>-->
                    <?=
                    Html::submitButton('Enviar', [
                        'id' => "IngresoLog",
                        'class' => 'btn btn-primary g-recaptcha  btn-signin',
                        //'class' => ['btn btn-primary', 'text-center'], 
                        'name' => 'contact-button'
                    ])
                    ?>
<?php ActiveForm::end(); ?>
                    <!--</form>-->
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

    <!-- ======= Map Section ======= -->
    <section class="map mt-2">
        <div class="container-fluid p-0">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.641555361363!2d-79.00299038524328!3d-2.9190212978739165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xf7d9f888c06a78a9!2sUniversidad%20del%20Azuay!5e0!3m2!1ses-419!2sec!4v1599161400683!5m2!1ses-419!2sec" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        </div>
    </section><!-- End Map Section -->

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


