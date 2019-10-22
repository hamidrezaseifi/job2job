<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web/web';
	public $css = [
	    'css/site.css',
	    'css/banner.css',
	    'css/footer.css',
	    'css/menuline.css',
			'css/jquery-ui.min.css',
			'css/bootstrap.css',
			'angular/angular-material.min.css',
			'css/icon.css'
	];
	public $js = [
			'js/jquery-3.1.0.min.js',
			'js/jquery-ui.min.js',
			'angular/angular.min.js',
			'angular/angular-animate.js',
			'angular/angular-aria.min.js',
			'angular/angular-messages.min.js',
			'angular/angular-material.min.js',
			'angular/angular-cookies.min.js',
			'angular/clickoutside.directive.js'
	];
	public $depends = [ // 'yii\web\YiiAsset',
		                    // 'yii\bootstrap\BootstrapAsset',
	];
	public $jsOptions = [
			'position' => 1
	];
}
