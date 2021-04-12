<?php


/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->getHostInfo() . '/dyac/frontend/web/index.php/site';
?>
Estimado, <?= $user->use_nombre . ' ' . $user->use_apellido ?>,

Su solicitud para cuenta de INVESTIGADOR, fue NEGADA.

Si considera que es un error, puede enviar nuevamente una solicitud de aprobación.

<?= $verifyLink ?>
