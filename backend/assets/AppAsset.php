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
        'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        'angular/angular-material.min.css',
        'css/icon.css'
    ];
    public $js = [
		'js/jquery-3.1.0.min.js',
        'js/jquery-ui.min.js',
        'js/bootstrap.min.js',
        'angular/angular.min.js',
        'angular/angular-animate.js',
        'angular/angular-aria.min.js',
        'angular/angular-messages.min.js',
        'angular/angular-material.min.js',
        'angular/angular-cookies.min.js',
    ];
    public $depends = [
        
    ];
    
    public $jsOptions = ['position' => 1];
}
