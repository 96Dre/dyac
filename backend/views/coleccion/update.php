<?php

use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\coleccion\Coleccion */
/* @var $coleccionpais frontend\models\coleccionpais\Coleccionpais */
/* @var $palabraclave frontend\models\palabraclave\Palabraclave */
/* @var $coleccionpersona frontend\models\coleccionpersona\Coleccionpersona */
/* @var $atributosExtra backend\models\atributoextra\Atributoextra */
/* @var $atrExtra frontend\models\coleccionatributoex\Coleccionatributoex */
/* @var $disciplina backend\models\disciplina\Disciplina */
/* @var $pais backend\models\pais\Pais */
/* @var $colaborador */

$this->title = Yii::t('app', 'Update: {name}', [
    'name' => $model->col_titulo,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coleccions'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->col_id, 'url' => ['view', 'id' => $model->col_id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<main id="main">
    <div class="coleccion-update">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
            </div>
        </section>
        <!-- End Header Page Section -->

        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">

                <?= $this->render('_form', [
                    'model' => $model,
                    'disciplina' => $disciplina,
                    'coleccionpais' => $coleccionpais,
                    'pais' => $pais,
                    'palabraclave' => $palabraclave,
                    'colaborador' => $colaborador,
                    'coleccionpersona' => $coleccionpersona,
                    'atributosExtra' => $atributosExtra,
                    'atrExtra' => $atrExtra,
                ]) ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>
