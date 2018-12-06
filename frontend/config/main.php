<?php
use yii\helpers\Url;

$params = array_merge ( 
    require (__DIR__ . '/../../common/config/params.php'), 
    require (__DIR__ . '/../../common/config/params-local.php'), 
    require (__DIR__ . '/params.php'), 
    require (__DIR__ . '/params-local.php') );

return [
		'id' => 'app-frontend',
		'basePath' => dirname ( __DIR__ ),
		'controllerNamespace' => 'frontend\controllers',
		'bootstrap' => [ // 'log'
		],
		'language' => 'en',
		'modules' => [ ],
		'components' => [
				'request' => [
						'csrfParam' => '_csrf-frontend',
    				    'parsers' => [
    				        'application/json' => 'yii\web\JsonParser',
    				    ]
				],
				'user' => [
						'identityClass' => 'common\lib\SiteUserModel',
						'enableAutoLogin' => true,
						'identityCookie' => [
								'name' => '_identity-frontend',
								'httpOnly' => true
						]
				],
				'session' => [
						// this is the name of the session cookie used for login on the frontend
						'name' => 'advanced-frontend'
				],
				'log' => [ /*
				            * 'traceLevel' => YII_DEBUG ? 3 : 0,
				            * 'targets' => [
				            * [
				            * 'class' => 'yii\log\FileTarget',
				            * 'levels' => ['error', 'warning'],
				            * ],
				            * ],
				            */
				],
				'errorHandler' => [
						'errorAction' => 'site/error'
				],
				'urlManager' => [
						'enablePrettyUrl' => true,
						'showScriptName' => false,
						'rules' => [
								'<controller>/dashboard/<ac:\w+>' => '<controller>/dashboard',
    						    'site/branchview/<b:\w+>' => 'site/branchview',
    						    'site/branchview/<t:\w+>/<b:\w+>' => 'site/branchview',
    						    'site/jobview/<id:\w+>' => 'site/jobview'
						]
				],
				'assetManager' => [
						'bundles' => [
								'yii\bootstrap\BootstrapAsset' => [
										'css' => [ ]
								],
								'yii\bootstrap\BootstrapPluginAsset' => [
										'js' => [ ]
								],
								'yii\web\JqueryAsset' => [
										'js' => [ ]
								]
						]
				],
				'mobileDetect' => [
						'class' => '\skeeks\yii2\mobiledetect\MobileDetect'
				]

		],
		'params' => $params
];
