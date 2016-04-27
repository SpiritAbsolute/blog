<?php
namespace app\modules\user\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\modules\user\models\LoginForm;
use app\modules\user\models\EmailConfirmForm;
use app\modules\user\models\PasswordResetRequestForm;
use app\modules\user\models\PasswordResetForm;
use app\modules\user\models\SignupForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class DefaultController extends Controller
{
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
		$model = new SignupForm();
		if ($model->load(Yii::$app->request->post()))
		{
			if ($model->si2gnup())
			{
				Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш электронный адрес.');
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
			Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
		else
			Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');

		return $this->goHome();
	}

	public function actionPasswordResetRequest()
	{
		$model = new PasswordResetRequestForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate())
		{
			if ($model->sendEmail())
			{
				Yii::$app->getSession()->setFlash('success', 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.');
				return $this->goHome();
			}
			else
			{
				Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
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
			$model = new PasswordResetForm($token);
		}
		catch (InvalidParamException $e)
		{
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
		{
			Yii::$app->getSession()->setFlash('success', 'Спасибо! Пароль успешно изменён.');
			return $this->goHome();
		}

		return $this->render('passwordReset', [
			'model' => $model,
		]);
	}
}
