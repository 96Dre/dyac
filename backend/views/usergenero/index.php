<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\assets\AppAsset;
AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\usergenero\UsergeneroSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usergeneros');
//$this->params['breadcrumbs'][] = $this->title;
?>
<main id="main">
    <div class="usergenero-index">

        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>

                    <p>
                        <?= Html::a('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-secondary']) ?>
                        <a href="<?= Url::to(['site/index'])?>" class="btn btn-secondary"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
                    </p>
                </div>
            </div>
        </section>
        <!-- End Header Page Section -->

        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <div class="container">

                <?= Yii::$app->session->getFlash('msg') ?>

                <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
                <br>
                <br>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                      //  'uge_id',
                        'uge_nombre',

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

            </div>
        </section>
        <!-- End Bod Page Section -->

    </div>
</main>




