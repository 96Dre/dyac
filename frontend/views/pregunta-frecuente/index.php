<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\tabs\TabsX;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use frontend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\preguntafrecuente\PreguntaFrecuenteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
AppAsset::register($this);
$this->title = 'Preguntas frecuentes';
\yii\web\YiiAsset::register($this);
?>

<main id="main">
    <div class="">
        <!-- ======= Header Page Section ======= -->
        <section class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
            </div>
        </section>

        <!-- ======= Body Page Section ======= -->
        <section class="about" data-aos="fade-up">
            <section class="service-details">
                <div class="container">
                    <?php
                    $cont = 1;
                    foreach ($model as $pre) {
                        ${"titulo" . $cont} = $pre->pfr_pregunta;
                        ${"contenido" . $cont} = "<h2>" . $pre->pfr_pregunta . "</h2><p class='text-justify' >" . $pre->pfr_respuesta . "</p>";
                        $cont = $cont + 1;
                    }

                    $it = array();
                    $bandera = 0;
                    for ($i = 1; $i < $cont; $i++) {
                        $it[$i]["label"] = ${"titulo" . $i};
                        $it[$i]["content"] = ${"contenido" . $i};
                        if ($bandera == 0) {
                            $it[$i]["active"] = true;
                            $bandera++;
                        } else {
                             $it[$i]["active"] = true;    
                        }
                    }

                    echo TabsX::widget([
                        'items' => $it,
                        'position' => TabsX::POS_LEFT, //POS_ABOVE; POS_BELOW; POS_LEFT; POS_RIGHT
                        'encodeLabels' => false
                    ]);

                    //$this->registerJs("$('.in').show(); ");
                    ?>



                </div>
                </div>            
                </main>
