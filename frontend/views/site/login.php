
<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Url;
use frontend\assets\AppAsset;

AppAsset::register($this);

$this->title = 'Iniciar sesión';
?>
<head>        
    <link rel="stylesheet" type="text/css" href="<?= Url::base() ?>/captcha2021/estilo.css">
</head>
<main id="main">
    <!-- ======= Login Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>

        </div>
    </section><!-- End Login Section -->
    <!-- ======= Login Section ======= -->

    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">
            <?= Yii::$app->session->getFlash('msg') ?>
            <div class="row">

                <div class="col-lg-12">

                    <?php
                    $form = ActiveForm::begin([
                                'id' => 'login-form',
                                'layout' => 'horizontal',
                                'fieldConfig' => [
                                    /* 'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>", */
                                    'labelOptions' => ['class' => 'col-lg-1 control-label'],
                                ],
                    ]);
                    ?>



<!--<img id="loginform-captcha-image" src="/dyac/frontend/web/site/captcha?v=5ff7e346d93b15.01719096" alt=""> -->
<!--   <img id="loginform-captcha-image" src="/micomunidad/web/site/captcha?v=5ff7e346d93b15.01719096" alt=""> -->
                    <?php
//                    $tag = $form->field($model, 'captcha')->widget(Captcha::className(), [
//                        //'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
//                        ]);                    
//                   // $tag = preg_replace('/dyac/frontend/', 'micomunidad', $tag);
//                  //  $tag = str_replace("/dyac/frontend/", "/micomunidad/", $tag);
//                    echo $tag;
                    ?>






                    <div id="Contenedor">   

                        <?php // $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder' => 'Correo electrónico'])->label('Email') ?>                                                
                        <?php // $form->field($model, 'password')->passwordInput()->label('Contraseña') ?>

                        <label class="text-center"><b>Correo electrónico</b></label>
                        <input type="email" id="loginform-email" name="LoginForm[email]" class="form-control" placeholder="Correo electrónico, Ej. dyac@gmail.com" aria-describedby="sizing-addon1" required>
                        <label class="text-center"><b>Contraseña</b></label>
                        <input type="password" id="loginform-password" name="LoginForm[password]" class="form-control" placeholder="Ingrese su contraseña de acceso" aria-describedby="sizing-addon1" required>

                        <?php /* echo $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                          'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                          ]) */ ?>
                        <?= $form->field($model, 'rememberMe')->checkbox()->label('Recordarme') ?>
                        <div class=" text-center">
                            <span class="text-primary h3"><strong><?= "Validar Captcha"; ?></strong></span>
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
                        <div class="row">                            
                            <div class="col-md-2"></div>
                            <div class="col-md-4">
                                <?=
                                Html::submitButton('Ingresar', [
                                    'id' => "IngresoLog",
                                    'class' => 'btn btn-primary g-recaptcha  btn-signin',
                                    //'class' => 'btn btn-primary',
                                    'name' => 'login-button'])
                                ?>
                            </div>
                            <div class="col-md-4">
                                <a href="<?= Url::to(['site/index']) ?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Cancelar</a>
                            </div>
                        </div>
                        <br>    
                    </div>





                    <?php ActiveForm::end(); ?>

                    <div style="color:#999;margin:1em 0">
                        ¿No tiene una cuenta? <?= Html::a('Regístrese ahora.', ['site/signup']) ?>
                        <br> <br>
                        Si olvido su contraseña puede <?= Html::a('restablecer la contraseña.', ['site/request-password-reset']) ?>
                        <br> <br>
                        ¿No recibió el email de verificación? <?= Html::a('Reenviar email.', ['site/reenviaremailverificacion']) ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

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


