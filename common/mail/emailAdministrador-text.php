<?php


/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->getHostInfo() . '/dyac/backend/web/index.php/user';
?>
Estimado, <?= $user->use_nombre . ' ' . $user->use_apellido ?>,

Su cuenta fue registrada como ADMINISTRADOR de la aplicación.

Por favor, visite el siguiente enlace para acceder al panel de administración.

<?= $verifyLink ?>
