<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->getHostInfo() . '/dyac/frontend/web/index.php/site/verify-email?token=' . $user->verification_token;
//$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);

?>
<div class="verify-email">
    <p>Estimado, <?= Html::encode($user->use_nombre . ' ' . $user->use_apellido) ?>,</p>

    <p>Por favor, siga el enlace a continuación para verificar su correo electrónico:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
