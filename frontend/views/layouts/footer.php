<?php

use frontend\assets\AppAsset;

AppAsset::register($this);

use yii\helpers\Url;

/*

  use yii\helpers\Html;

  <footer class="footer">
  <div class="container">
  <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

  <p class="pull-right"><?= Yii::powered() ?></p>
  </div>
  </footer>



  --------------------------------------------------
  <div class="footer-newsletter">
  <div class="container">
  <div class="row">
  <div class="col-lg-6">
  <h4>Our Newsletter</h4>
  <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
  </div>
  <div class="col-lg-6">
  <form action="" method="post">
  <input type="email" name="email"><input type="submit" value="Subscribe">
  </form>
  </div>
  </div>
  </div>
  </div>
 */
?>


<!-- ======= Footer ======= -->
<footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">



    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Menú...</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?= Url::to(['/']) ?>">Inicio</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?= Url::to(['/site/about']) ?>">Nosotros</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?= Url::to(['/site/colecciones']) ?>">Colecciones</a></li>                       
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>...</h4>
                    <ul>                        
                        <li><i class="bx bx-chevron-right"></i> <a href="<?= Url::to(['/site/investigador']) ?>">Investigadores</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?= Url::to(['/site/contact']) ?>">Contacto</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="<?= Url::to(['/pregunta-frecuente']) ?>">Preguntas frecuentes</a></li>
                    </ul>
                </div>                

                <div class="col-lg-3 col-md-6 footer-contact">
                    <h4>Contacto</h4>
                    <p>
                        Av. 24 de Mayo 7-77 y Hernán Malo
                        <strong>Teléfono:</strong> (593) 7 4091000<br>
                        <strong>Correo electrónico:</strong> dyac@uazuay.edu.ec<br>
                    </p>

                </div>

                <div class="col-lg-3 col-md-6 footer-info">
                    <h3>Redes sociales</h3>                    
                    <div class="social-links mt-3">
                        <a href="https://twitter.com/uazuay?lang=es&fbclid=IwAR00SSK1cEq8SG23YmEy69h6JwI8TtC7NjaWySxUesJPtTkF50WEpCqAwAc" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="https://www.facebook.com/uazuay" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/uda.oficial/?fbclid=IwAR19X-mpVQ7RGIOLLl1hPPE2l_9iom8iR3ftsght8s7fR5Eq7_rhvs7a1jE" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <!--<a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>-->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>Moderna</span></strong>. Todos los derechos reservados
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/free-bootstrap-template-corporate-moderna/ -->
            <!--Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>-->
<?= date('Y') ?>
        </div>
    </div>
</footer><!-- End Footer -->