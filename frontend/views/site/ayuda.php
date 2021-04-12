<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AppAsset;
use kartik\tabs\TabsX;

AppAsset::register($this);

$this->title = 'Ayuda';

?>
<!-- on your view layout file HEAD section -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
<main id="main">

    <!-- ======= About Us Section ======= -->
    <section class="breadcrumbs">
        <div class="container">

            <div class="d-flex justify-content-between align-items-center">
                <h1><?= Html::encode($this->title) ?></h1>

            </div>

        </div>
    </section><!-- End About Us Section -->

    <!-- ======= About Section ======= -->
    <section class="about" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 pt-12 pt-lg-0">
                   
                    

                    <?php
                 /*   $items = [
                        [
                            'label' => '<i class="fas fa-home"></i> Home',
                            'content' => 'holaaaa 1',
                            'encode' => false,
                            //'active'=>true
                        ],
                        [
                            'label' => '<i class="fas fa-user"></i> Profile',
                            'content' => 'holaaaa 2',
                            'encode' => false,
                            //  'active'=>false
                        ],

                        [
                            'label' => '<i class="fas fa-king"></i> Disabled',
                            'content' => 'holaaaa 3',
                            'encode' => false,
                            // 'active'=>false
                        ],
                    ];


                    // Left
                    echo TabsX::widget([
                        'items' => $items,
                        'position' => TabsX::POS_LEFT,
                        'align' => TabsX::ALIGN_CENTER,
                        //'bordered'=>true,,
                        'encodeLabels' => false,

                    ]);

                    
                    
                    
                    */
                    $content1 = " <h3>¿Como agregar una colección?</h3>
                    <br>
                    <p>
                        1. Escoja la opción <strong>Mis colecciones</strong> en el menú principal.
                    </p>
                    <p>
                        2. Pulse el botón <img src=\"". Url::to('@web/img/ayuda/BotonAgregar.png')."\" class=\"img-fluid\"
                                               alt=\"\">
                    </p>
                    <p>
                        3. Llene el formulario con los <strong>datos correspondientes</strong> y pulse el botón
                        <img src=\"". Url::to('@web/img/ayuda/botonGuardar.png') ."\" class=\"img-fluid\" alt=\"\">
                        para guardar la colección.
                    </p>
                    <p>
                        4. La colección entrará en <strong>etapa de revisión</strong> por un administrador del sistema.
                    </p>
                    <p>
                        5. Se le <strong>notificará</strong> a su correo si la coleccion fue:
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp; a) Aprobada
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp; b) Negada
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp; c) Bloqueada
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Se adjuntarán las observaciones correspondientes.
                        Puede <strong>revisar el estado de la colección</strong> pulsando el botón
                        <img src=\"". Url::to('@web/img/ayuda/botonVer.png') ."\" class=\"img-fluid\" alt=\"\">
                    </p>
                    <p>
                        <strong>Nota:</strong>
                        <br>Si la colección es negada, puede <strong>volver a enviar a revisión</strong> con los cambios necesarios.
                        <br>Si fue bloqueada, ya <strong>no puede ser enviada</strong> a revisión.
                        <br>Las colecciones pueden ser <strong>bloqueadas luego de ser aprobadas</strong>, si se observan contenidos
                        inapropiados.
                    </p>

                    <br>";
                    
                    
                    
                    $content2 = "<h3>¿Como agregar un archivo?</h3>
                    <br>
                    <p>
                        1. La <strong>colección debe ser aprobada</strong>
                    </p>
                    <p>
                        2. Pulse el botón <img src=\"". Url::to('@web/img/ayuda/botonVer.png') ."\" class=\"img-fluid\" alt=\"\">
                    </p>
                    <p>
                        3. Se habilitira el boton Archivos. Pulse el botón <img src=\"". Url::to('@web/img/ayuda/botonArchivo.png') ."\" class=\"img-fluid\" alt=\"\">
                    </p>
                    <p>
                        4. Para agregar un archivo, seleccione el tipo de archivo que desea agregar <img src=\"". Url::to('@web/img/ayuda/tipoArchivo.png') ."\" class=\"img-fluid\" alt=\"\">
                        y presione el botón <img src=\"". Url::to('@web/img/ayuda/BotonAgregar.png') ."\" class=\"img-fluid\"
                                                 alt=\"\">
                    </p>
                    <p>
                        5. Llene el formulario con los <strong>datos correspondientes</strong> y pulse el botón
                        <img src=\"". Url::to('@web/img/ayuda/botonGuardar.png') ."\" class=\"img-fluid\" alt=\"\">
                        para guardar el archivo.
                    </p>
                    <p>
                        6. El archivo entrará en <strong>etapa de revisión</strong> por un administrador del sistema.
                    </p>
                    <p>
                        7. Se le <strong>notificará</strong> a su correo si el archivo fue:
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp; a) Aprobado
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp; b) Negado
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp; c) Bloqueado
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp;Se adjuntarán las observaciones correspondientes.
                        Puede <strong>revisar el estado del archivo</strong> pulsando el botón
                        <img src=\"". Url::to('@web/img/ayuda/botonVer.png') ."\" class=\img-fluid\" alt=\"\">
                    </p>
                    <p>
                        <strong>Nota:</strong>
                        <br>Si el archivo es negado, puede <strong>volver a enviar a revisión</strong> con los cambios necesarios.
                        <br>Si fue bloqueado, ya <strong>no puede ser enviada</strong> a revisión.
                        <br>Los archivos pueden ser <strong>bloqueadas luego de ser aprobadas</strong>, si se observan contenidos
                        inapropiados.
                    </p>
";
                    $content3 = "Contenido 3";
                    $content4 = "Contenido 4";
                    
$items = [
    [
        'label'=>'<i class="fas fa-folder-open"></i> ¿Como agregar una colección?',
        'content'=>$content1,
        'active'=>true
    ],
     [
        'label'=>'<i class="fas fa-file"></i> Como agregar un archivo?',
        'content'=>$content2,
        'active'=>true
    ], 
];
// Left
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_LEFT, //POS_ABOVE; POS_BELOW; POS_LEFT; POS_RIGHT
    'encodeLabels'=>false
]);

 // $this->registerJs("$('.in').hide(); ");
                    ?>
                </div>

                
                
          
              
                
                
                
                
                
                
            </div>
        </div>
    </section><!-- End About Section -->


</main><!-- End #main -->
