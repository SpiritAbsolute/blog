<?php
namespace app\modules\user;

use Yii;

class Module extends \yii\base\Module
{
	public $defaultRole = 'user';

	public $emailConfirmTokenExpire = 259200;

	public $passwordResetTokenExpire = 3600;

	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t('modules/user/' . $category, $message, $params, $language);
	}
}
