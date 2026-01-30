<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class StepModalAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/register.css?3',
    ];
    public $js = [
        //'js/register.js?18',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}
