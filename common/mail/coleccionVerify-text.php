<?php


/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $titulo*/
/* @var $estado*/
/* @var $observacion*/

?>
Estimado, <?= $user->use_nombre . ' ' . $user->use_apellido ?>,

Su coleccion "<?= $titulo ?>", ha sido <?php if ($estado == 'P') {
    echo 'Pendiente';
}
if ($estado == 'A') {
    echo 'Aprobado';
}
if ($estado == 'N') {
    echo 'Negado';
}
if ($estado == 'B') {
    echo 'Bloqueado';
} ?>.

Observaciones:

    <?php
    if ($observacion == '') {
        echo 'Ninguno';
    }else{
        echo $observacion;
    }
    ?>


