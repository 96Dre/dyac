<?php

use yii\helpers\Html;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $model backend\models\usergenero\Usergenero */

$this->title = Yii::t('app', 'Update: {name}', [
    'name' => $model->uge_nombre,
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usergeneros'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->uge_id, 'url' => ['view', 'id' => $model->uge_id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<main id="main">
    <div class="usergenero-update">
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
                ]) ?>

            </div>
        </section>
        <!-- End Bod Page Section -->
    </div>
</main>

