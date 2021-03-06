<?php
namespace app\modules\user\controllers\frontend;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\user\models\form\LoginForm;
use app\modules\user\models\frontend\form\EmailConfirmForm;
use app\modules\user\models\frontend\form\PasswordResetRequestForm;
use app\modules\user\models\frontend\form\PasswordResetForm;
use app\modules\user\models\frontend\form\SignupForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\modules\user\Module;

class DefaultController extends Controller
{
	/**
	 * @var \app\modules\user\Module
	 */
	public $module;

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout'],
				'rules' => [
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'logout' => ['post'],
				],
			],
		];
	}

	public function actions()
	{
		return [
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionIndex()
	{
		return $this->redirect(['profile/index'], 301);
	}

	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest)
		{
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login())
		{
			return $this->goBack();
		}
		return $this->render('login', [
			'model' => $model,
		]);
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	public function actionSignup()
	{
		$model = new SignupForm($this->module->defaultRole);
		if ($model->load(Yii::$app->request->post()))
		{
			if ($model->signup())
			{
				Yii::$app->getSession()
					->setFlash('success', Module::t('module', 'FLASH_EMAIL_CONFIRM_REQUEST'));
				return $this->goHome();
			}
		}

		return $this->render('signup', [
			'model' => $model,
		]);
	}

	public function actionEmailConfirm($token)
	{
		try
		{
			$model = new EmailConfirmForm($token);
		}
		catch (InvalidParamException $e)
		{
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->confirmEmail())
			Yii::$app->getSession()
				->setFlash('success', Module::t('module', 'FLASH_EMAIL_CONFIRM_SUCCESS'));
		else
			Yii::$app->getSession()
				->setFlash('error', Module::t('module', 'FLASH_EMAIL_CONFIRM_ERROR'));

		return $this->goHome();
	}

	public function actionPasswordResetRequest()
	{
		$model = new PasswordResetRequestForm($this->module->passwordResetTokenExpire);
		if ($model->load(Yii::$app->request->post()) && $model->validate())
		{
			if ($model->sendEmail())
			{
				Yii::$app->getSession()
					->setFlash('success', Module::t('module', 'FLASH_PASSWORD_RESET_REQUEST'));
				return $this->goHome();
			}
			else
			{
				Yii::$app->getSession()
					->setFlash('error', Module::t('module', 'FLASH_PASSWORD_RESET_ERROR'));
			}
		}

		return $this->render('passwordResetRequest', [
			'model' => $model,
		]);
	}

	public function actionPasswordReset($token)
	{
		try
		{
			$model = new PasswordResetForm($token,
				$this->module->passwordResetTokenExpire);
		}
		catch (InvalidParamException $e)
		{
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
		{
			Yii::$app->getSession()
				->setFlash('success', Module::t('module', 'FLASH_PASSWORD_RESET_SUCCESS'));
			return $this->goHome();
		}

		return $this->render('passwordReset', [
			'model' => $model,
		]);
	}
}
