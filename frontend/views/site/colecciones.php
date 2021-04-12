<?php
/* @var $this yii\web\View */
/* @var $colecciones frontend\models\coleccion\Coleccion */

/* @var $titulo */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);
$this->title = $titulo;
\yii\web\YiiAsset::register($this);
$discList = backend\models\disciplina\Disciplina::find()->select(['dis_id', 'dis_nombre'])->orderBy('dis_nombre')->all();
?>

<main id="main">
    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>

                <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
                <section class="breadcrumbs"> <!-- Buscar -->
                    <!--        *************  Búsqueda avanzada  ****************-->

                    <div class="row  rounded col-sm-12">
                        <div id="busquenormal" class="col-sm-7 col-md-7">
                            <?php
                            $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],
                                'enableClientValidation' => false,
                                'enableAjaxValidation' => false,
                            ]);
                            ?>
                            <div class="row col-sm-12 col-md-12">
                                <div class="col-sm-9 col-md-9">
                                    <?= $form->field($model_coleccion, 'col_titulo')->textInput(['maxlength' => true, 'placeholder' => 'Ingresar colección, investigador, palabras claves'])->label(false) ?>
                                </div>
                                <div class="col-sm-2 col-md-2">
                                    <center>
                                        <?= Html::submitButton('<span class="glyphicon glyphicon-floppy-disk"></span> ' . Yii::t('app', 'Buscar'), ['class' => 'btn btn-primary']) ?>
                                    </center>
                                </div>

                            </div>
                            <?php ActiveForm::end(); ?>
                        </div>

                        <div class="col-sm-5 col-md-5">
                            <a href="<?= Url::to(['/']) ?>">
                                Búsqueda avanzada
                            </a>
                        </div>

                    </div>
                </section> <!-- Fin de buscar -->


            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= Blog Section ======= -->
    <section class="blog" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">

            <p display="flex" justify-content="center" align-items="center">
                <?php
                echo str_repeat('&nbsp;', 40) . '| ';
                ?>
                <a href="<?= Url::to(Url::base() . '/index.php/site/colecciones') ?>">
                    TODOS
                </a>
                <?php
                echo '| ';
                foreach (range('A', 'Z') as $letra) {
                    ?>
                    <a href="coleccioneslike?like=<?= $letra ?> "><?= $letra ?></a> |
                <?php } ?>
            </p>
            <div class="row">
                <div class="col-lg-12 entries">
                    <section class="service-details">
                        <div class="container">
                            <div class="row">

                                <?php if (count($colecciones) != 0) { ?>
                                    <?php foreach ($colecciones as $item) { ?>
                                        <div class="col-md-3 d-flex align-items-stretch" data-aos="fade-up">
                                            <div class="card">
                                                <div class="card-img text-center">
                                                    <img src="<?= Url::to(Url::base() . '/../../backend/web/img/coleccion/' . $item->col_portada) ?>"
                                                         height="150" alt="...">
                                                </div>
                                                <div class="card-body">
                                                    <h5 class="card-title"><a
                                                                href="<?= Url::to(['/site/coleccionview', 'id' => $item->col_id]) ?>"><?= $item->col_titulo ?></a>
                                                    </h5>
                                                    <p class="card-text"><?= substr($item->col_descripcion, 0, 40) . '...' ?> </p>
                                                    <div class="read-more">
                                                        <a href="<?= Url::to(['/site/coleccionview', 'id' => $item->col_id]) ?>"><i
                                                                    class="icofont-arrow-right"></i> Ver más</a></div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <h4><p> No hay colecciones disponibles.</p></h4>
                                <?php } ?>
                            </div>
                        </div>
                    </section>

                </div><!-- End blog entries list -->


            </div><!-- End row -->

        </div><!-- End container -->

    </section><!-- End Blog Section -->

</main><!-- End #main -->