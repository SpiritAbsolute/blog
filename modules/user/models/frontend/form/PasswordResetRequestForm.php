<?php
namespace app\modules\user\models\frontend\form;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;
use app\modules\user\Module;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
	public $email;

	private $_user = false;
	private $_timeout;

	public function __construct($timeout, $config = [])
	{
		$this->_timeout = $timeout;
		parent::__construct($config);
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
			['email', 'exist',
				'targetClass' => '\app\modules\user\models\User',
				'filter' => ['status' => User::STATUS_ACTIVE],
				'message' => 'There is no user with such email.'
			],
		];
	}

	public function attributeLabels()
	{
		return [
			'email' => Module::t('module', 'USER_EMAIL'),
		];
	}

	/**
	 * @param string $attribute
	 * @param array $params
	 */
	public function validateIsSent($attribute, $params)
	{
		if (!$this->hasErrors() && $user = $this->getUser()) {
			if (User::isPasswordResetTokenValid($user->$attribute, $this->_timeout))
			{
				$this->addError($attribute,
					Module::t('module', 'ERROR_TOKEN_IS_SENT'));
			}
		}
	}

	/**
	 * Sends an email with a link, for resetting the password.
	 *
	 * @return boolean whether the email was send
	 */
	public function sendEmail()
	{
		if ($user = $this->getUser())
		{
			$user->generatePasswordResetToken();
			if ($user->save())
			{
				return Yii::$app->mailer
					->compose(['text' => '@app/modules/user/mail/passwordReset'],
						['user' => $user])
					->setFrom([Yii::$app->params['supportEmail'] =>
						Yii::$app->name . ' robot'])
					->setTo($this->email)
					->setSubject('Password reset for ' . Yii::$app->name)
					->send();
			}
		}
		return false;
	}

	/**
	 * Finds user by [[username]]
	 *
	 * @return User|null
	 */
	public function getUser()
	{
		if ($this->_user === false) {
			$this->_user = User::findOne([
				'email' => $this->email,
				'status' => User::STATUS_ACTIVE,
			]);
		}
		return $this->_user;
	}
}
