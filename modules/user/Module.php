<?php
namespace app\modules\user;

use Yii;
use yii\console\Application as ConsoleApplication;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\user\controllers';

	public $passwordResetTokenExpire = 3600;

	public function init()
	{
		parent::init();

		if (Yii::$app instanceof ConsoleApplication)
		{
			$this->controllerNamespace = 'app\modules\user\commands';
		}
	}

	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t('modules/user/' . $category, $message, $params, $language);
	}
}
