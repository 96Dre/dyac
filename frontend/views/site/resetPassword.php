<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use frontend\assets\AppAsset;
AppAsset::register($this);

$this->title = 'Restablecer contraseña';
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

            <p>Ingrese su nueva contraseña:</p>

            <div class="row">
                <div class="col-lg-6">
                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                    <?= $form->field($model, 'password') ->passwordInput()-> label('Contraseña') ?>

                    <?= $form->field($model, 'repeat_password')->passwordInput()-> label('Repetir Contraseña') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Restablecer', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </section>
    <!-- ======= End Body Section ======= -->
</main><!-- End #main -->