<?php


/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->getHostInfo() . '/dyac/frontend/web/index.php/site/verify-email?token=' . $user->verification_token;
?>
Estimado, <?= $user->use_nombre . ' ' . $user->use_apellido ?>,

Por favor, siga el enlace a continuación para verificar su correo electrónico:

<?= $verifyLink ?>
