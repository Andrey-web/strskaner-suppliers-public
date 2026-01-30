<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Step3Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/step3.css?1',
    ];
    public $js = [
        'js/step3.js?20',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
