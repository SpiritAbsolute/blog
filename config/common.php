<?php
use yii\helpers\ArrayHelper;

$params = ArrayHelper::merge(
	require(__DIR__.'/params.php'),
	require(__DIR__.'/params-local.php')
);

return [
	'name' => 'Self-development',
	'basePath' => dirname(__DIR__),
	'bootstrap' => [
		'log',
		'app\modules\admin\Bootstrap',
		'app\modules\main\Bootstrap',
		'app\modules\user\Bootstrap',
	],
	'components' => [
		'db' => [
			'class' => 'yii\db\Connection',
			'charset' => 'utf8',
		],
		'authManager' => [
			'class' => 'app\components\rbac\AuthManager',
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				[
					'class' => 'yii\web\GroupUrlRule',
					'prefix' => 'admin',
					'routePrefix' => 'admin',
					'rules' => [
						'' => 'default/index',
						'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
						'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
						'<_m:[\w\-]+>' => '<_m>/default/index',
						'<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
					],
				],

				'' => 'main/default/index',
				'contact' => 'main/contact/index',
				'<_a:error>' => 'main/default/<_a>',
				'<_a:(login|logout|signup|email-confirm|password-request-reset|password-reset)>'
					=> 'user/default/<_a>',

				'<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w-]+>' => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
				'<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
				'<_m:[\w\-]+>' => '<_m>/default/index',
				'<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
			],
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
		],
		'cache' => [
			'class' => 'yii\caching\DummyCache',
		],
		'log' => [
			'class' => 'yii\log\Dispatcher',
		],
		'i18n' => [
			'translations' => [
				'app' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'forceTranslation' => true,
				],
			],
		],
	],
	'modules' => [],
	'params' => $params,
];
