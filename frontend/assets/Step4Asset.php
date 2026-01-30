<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class Step4Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/step4.css?2',
    ];
    public $js = [
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
