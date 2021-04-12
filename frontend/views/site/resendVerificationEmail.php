<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use frontend\assets\AppAsset;
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

                    <div class="form-group">
                        <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                        <a href="<?= Url::to(['site/index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Cancelar</a>

                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </section>
    <!-- ======= End Body Section ======= -->
</main><!-- End #main -->