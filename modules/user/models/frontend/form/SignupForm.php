<?php
namespace app\modules\user\models\frontend\form;

use yii\base\Model;
use app\modules\user\models\User;
use yii;
use app\modules\user\Module;

class SignupForm extends Model
{
	public $username;
	public $email;
	public $password;
	public $verifyCode;

	private $_defaultRole;

	public function __construct($defaultRole, $config = [])
	{
		$this->_defaultRole = $defaultRole;
		parent::__construct($config);
	}

	public function rules()
	{
		return [
			['username', 'filter', 'filter' => 'trim'],
			['username', 'required'],
			['username', 'unique', 'targetClass' => 'app\modules\user\models\User',
				'message' => 'This username has already been taken.'],
			['username', 'string', 'min' => 2, 'max' => 255],

			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'string', 'max' => 255],
			['email', 'unique', 'targetClass' => 'app\modules\user\models\User',
				'message' => 'This email address has already been taken.'],

			['password', 'required'],
			['password', 'string', 'min' => 6],

			['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
		];
	}

	public function attributeLabels()
	{
		return [
			'username' => Module::t('module', 'USER_USERNAME'),
			'email' => Module::t('module', 'USER_EMAIL'),
			'password' => Module::t('module', 'USER_PASSWORD'),
			'verifyCode' => Module::t('module', 'USER_VERIFY_CODE'),
		];
	}

	public function signup()
	{
		if (!$this->validate())
			return null;

		$user = new User();
		$user->username = $this->username;
		$user->email = $this->email;
		$user->status = User::STATUS_WAIT;
		$user->role = $this->_defaultRole;
		$user->setPassword($this->password);
		$user->generateAuthKey();
		$user->generateEmailConfirmToken();

		if (!$user->save())
			return null;

		Yii::$app->mailer->compose('@app/modules/user/mail/emailConfirm',
			['user' => $user])
			->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
			->setTo($this->email)
			->setSubject('Email confirmation for ' . Yii::$app->name)
			->send();

		return $user;
	}
}
