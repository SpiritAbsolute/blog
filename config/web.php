<?php

require_once(__DIR__.'/debug-local.php');

$config = [
	'id' => 'spirit',
	'defaultRoute' => 'main/default/index',
	'language'=>'ru-RU',
	'components' => [
		'request' => [
			'cookieValidationKey' => '',
		],
		'user' => [
			'identityClass' => 'app\modules\user\models\User',
			'enableAutoLogin' => true,
			'loginUrl' => ['user/default/login'],
		],
		'errorHandler' => [
			'errorAction' => 'main/default/error',
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
		],
	],
	'modules' => [
		'admin' => [
			'class' => 'app\modules\admin\Module',
			'layout' => '@app/views/layouts/admin',
			'modules' => [
				'user' => [
					'class' => 'app\modules\user\Module',
					'controllerNamespace' => 'app\modules\user\controllers\backend',
					'viewPath' => '@app/modules/user/views/backend',
				],
			],
		],
		'main' => [
			'class' => 'app\modules\main\Module',
		],
		'user' => [
			'class' => 'app\modules\user\Module',
			'controllerNamespace' => 'app\modules\user\controllers\frontend',
			'viewPath' => '@app/modules/user/views/frontend',
		],
	],
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
}

return $config;
