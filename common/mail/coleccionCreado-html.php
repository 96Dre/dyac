<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
/* @var $titulo*/
/* @var $estado*/
/* @var $observacion*/

?>
<div class="verify-email">
    <p>Estimado, <?= Html::encode($user->use_nombre . ' ' . $user->use_apellido) ?>,</p>
<p>tiene la colección "<?= $titulo ?>", pendiente para su aprobación.</p>
<?php /* ?>
    <p>Su coleccion "<?= $titulo ?>", ha sido <?php if ($estado == 'P') {
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
        } ?>. </p> 
<?php */ ?>
    <p>Observaciones: </p>
    <p>
        <?php
            if ($observacion == '') {
                echo 'Ninguno';
            }else{
                echo $observacion;
            }
        ?>

    </p>

</div>
