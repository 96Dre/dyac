<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->getHostInfo() . '/dyac/frontend/web/index.php/site';

?>
<div class="verify-email">
    <p>Estimado, <?= Html::encode($user->use_nombre . ' ' . $user->use_apellido) ?>,</p>

    <p>Su solicitud para cuenta de INVESTIGADOR, fue NEGADA.</p>

    <p>Si considera que es un error, puede enviar nuevamente una solicitud de aprobación.</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>


