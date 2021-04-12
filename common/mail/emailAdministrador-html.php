<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$verifyLink = Yii::$app->urlManager->getHostInfo() . '/dyac/backend/web/index.php/user';

?>
<div class="verify-email">
    <p>Estimado, <?= Html::encode($user->use_nombre . ' ' . $user->use_apellido) ?>,</p>

    <p>Su cuenta fue registrada como ADMINISTRADOR de la aplicación.</p>

    <p>Por favor, visite el siguiente enlace para acceder al panel de administración.</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>


