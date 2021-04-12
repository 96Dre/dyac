<?php


/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/index.php/site/reset-password', 'token' => $user->password_reset_token]);
?>
Hola <?= $user->use_nombre . ' ' . $user->use_apellido ?>,

Siga el enlace a continuación para restablecer su contraseña:

<?= $resetLink ?>
