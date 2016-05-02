<?php
namespace app\modules\main;

use Yii;
use yii\console\Application as ConsoleApplication;

class Module extends \yii\base\Module
{
	public $controllerNamespace = 'app\modules\main\controllers';

	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t('modules/main/' . $category, $message, $params, $language);
	}
}
