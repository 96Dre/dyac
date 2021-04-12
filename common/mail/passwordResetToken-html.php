<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/index.php/site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Hola <?= Html::encode($user->use_nombre . ' ' . $user->use_apellido) ?>,</p>

    <p>Siga el enlace a continuación para restablecer su contraseña:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
