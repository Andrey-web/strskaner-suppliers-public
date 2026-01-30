<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class RegistrationAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap.min.css',
        'css/register.css?4',
        'font/stylesheet.css?4',
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/css/suggestions.min.css',
    ];
    public $js = [
        'js/bootstrap.min.js',
        'js/registration.js?5',
        'js/maskedinput.min.js',
        'https://cdn.jsdelivr.net/npm/suggestions-jquery@20.3.0/dist/js/jquery.suggestions.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}
