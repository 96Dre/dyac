<?php


/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->getHostInfo() . '/dyac/frontend/web/index.php/user';
?>
Estimado, <?= $user->use_nombre . ' ' . $user->use_apellido ?>,

Su solicitud para cuenta de INVESTIGADOR, fue APROBADA.

Por favor, complete la información de su perfil en la aplicación ó por medio del siguiente enlace.

<?= $verifyLink ?>
