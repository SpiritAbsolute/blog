<?php
namespace app\modules\user;

use Yii;
use yii\console\Application as ConsoleApplication;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\user\controllers';

	public $emailConfirmTokenExpire = 259200;

	public $passwordResetTokenExpire = 3600;

	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t('modules/user/' . $category, $message, $params, $language);
	}
}
