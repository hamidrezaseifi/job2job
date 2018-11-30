<?php
//test
$db = [
	'class' => 'yii\db\Connection',
	'dsn' => 'mysql:host=localhost;dbname=job2job',
	'username' => 'root',
	'password' => 'Elec7342',
	'charset' => 'utf8',
	'tablePrefix' => 'j2j_',
];

if(isset($_SERVER['RDS_HOSTNAME']) && isset($_SERVER['RDS_PORT']) && isset($_SERVER['RDS_DB_NAME']))
{
	$dbhost = $_SERVER['RDS_HOSTNAME'];
	$dbport = $_SERVER['RDS_PORT'];
	$dbname = $_SERVER['RDS_DB_NAME'];
	$charset = 'utf8' ;
	
	$dsn = "mysql:host={$dbhost};port={$dbport};dbname={$dbname};charset={$charset}";
	$username = $_SERVER['RDS_USERNAME'];
	$password = $_SERVER['RDS_PASSWORD'];
	
	$db = [
			'class' => 'yii\db\Connection',
			'dsn' => $dsn,
			'username' => $username,
			'password' => $password,
			'charset' => 'utf8',
			'tablePrefix' => 'j2j_',
	];
	
}

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	$db = [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=job2job',
			'username' => 'root',
			'password' => 'Elec7342',
			'charset' => 'utf8',
			'tablePrefix' => 'j2j_',
		];
}

return [
	'components' => [
		'db' => $db,
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'viewPath' => '@common/mail',
			'useFileTransport' => true,
		],
	],
];
