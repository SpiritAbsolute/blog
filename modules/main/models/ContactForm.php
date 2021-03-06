<?php
namespace app\modules\main\models;

use Yii;
use yii\base\Model;
use app\modules\main\Module;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * @return array the validation rules.
	 */
	public function rules()
	{
		return [
			[['name', 'email', 'subject', 'body'], 'required'],
			['email', 'email'],
			[
				'verifyCode',
				'captcha',
				'captchaAction' => '/main/contact/captcha',
			],
		];
	}

	/**
	 * @return array customized attribute labels
	 */
	public function attributeLabels()
	{
		return [
			'name' => Module::t('module', 'CONTACT_NAME'),
			'email' => Module::t('module', 'CONTACT_EMAIL'),
			'subject' => Module::t('module', 'CONTACT_SUBJECT'),
			'body' => Module::t('module', 'CONTACT_MESSAGE'),
			'verifyCode' => Module::t('module', 'CONTACT_VERIFY_CODE'),
		];
	}

	/**
	 * Sends an email to the specified email address using the information collected by this model.
	 * @param  string  $email the target email address
	 * @return boolean whether the model passes validation
	 */
	public function contact($email)
	{
		if ($this->validate())
		{
			Yii::$app->mailer->compose()
				->setTo($email)
				->setFrom([
					Yii::$app->params['supportEmail'] => Yii::$app->name
				])
				->setReplyTo([$this->email => $this->name])
				->setSubject($this->subject)
				->setTextBody($this->body)
				->send();

			return true;
		}
		return false;
	}
}
