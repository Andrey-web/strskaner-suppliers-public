<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Step2Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/step2.css?3',
    ];
    public $js = [
        'js/step2.js?18',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
