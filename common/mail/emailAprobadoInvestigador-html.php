<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->getHostInfo() . '/dyac/frontend/web/index.php/user';

?>
<div class="verify-email">
    <p>Estimado, <?= Html::encode($user->use_nombre . ' ' . $user->use_apellido) ?>,</p>

    <p>Su solicitud para cuenta de INVESTIGADOR, fue APROBADA.</p>

    <p>Por favor, complete la información de su perfil en la aplicación ó por medio del siguiente enlace.</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>


