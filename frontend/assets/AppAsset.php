<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap',
        'vendor/bootstrap/css/bootstrap.min.css',
        'vendor/animate.css/animate.min.css',
        'vendor/icofont/icofont.min.css',
        'vendor/boxicons/css/boxicons.min.css',
        'vendor/venobox/venobox.css',
        'vendor/owl.carousel/assets/owl.carousel.min.css',
        'vendor/aos/aos.css',
        'css/style.css',
    ];
    public $js = [
        'vendor/jquery/jquery.min.js',
        'vendor/bootstrap/js/bootstrap.bundle.min.js',
        'vendor/jquery.easing/jquery.easing.min.js',
        'vendor/php-email-form/validate.js',
        'vendor/venobox/venobox.min.js',
        'vendor/waypoints/jquery.waypoints.min.js',
        'vendor/counterup/counterup.min.js',
        'vendor/owl.carousel/owl.carousel.min.js',
        'vendor/isotope-layout/isotope.pkgd.min.js',
        'vendor/aos/aos.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
