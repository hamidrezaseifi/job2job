<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web/web';
    public $css = [
        'css/site.css',
    	'css/jquery-ui.min.css',
    	'css/bootstrap.css',
    ];
    public $js = [
    		'js/jquery-3.1.0.min.js',
 		    'js/jquery-ui.min.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
    
    public $jsOptions = ['position' => 1];
}
