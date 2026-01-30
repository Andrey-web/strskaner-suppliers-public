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
        'css/bootstrap.min.css',
        'font/stylesheet.css',
        //'css/style.css',
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/css/suggestions.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/maskedinput.min.js',
        //'js/jquery.inputmask.js',
        //'js/Inputmask-5.x/dist/jquery.inputmask.js',

        'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/js/jquery.suggestions.min.js',
        //'js/step2.js?17',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
