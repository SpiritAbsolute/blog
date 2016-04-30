<?php
namespace app\modules\admin;

use yii\filters\AccessControl;

class Module extends \yii\base\Module
{
	public $layout = 'admin';

	public $controllerNamespace = 'app\modules\admin\controllers';

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
		];
	}
}
