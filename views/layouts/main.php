<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\components\widgets\Alert;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
	NavBar::begin([
		'brandLabel' => Yii::$app->name,
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar-inverse navbar-fixed-top',
		],
	]);
	echo Nav::widget([
		'options' => ['class' => 'navbar-nav navbar-right'],
		'activateParents' => true,
		'items' => array_filter([
			['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
			['label' => Yii::t('app', 'NAW_CONTACT'), 'url' => ['/main/contact/index']],

			Yii::$app->user->isGuest ? [
				'label' => Html::img('/images/menu/yii-icon.png',
					['alt' => Yii::t('app', 'NAV_ICON_LOGIN'), 'width'=>'20']),
				'items' => [
					['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']],
					['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']]
				],
				'encode' => false,
			] : false,

			!Yii::$app->user->isGuest ? [
				'label' => Html::img('/images/menu/yii-icon.png',
					['alt' => Yii::t('app', 'NAV_ICON_ADMIN'), 'width'=>'20']),
				'items' => [
					['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
					['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']],
					['label' => Yii::t('app', 'NAV_LOGOUT'), 'url' => ['/user/default/logout'],
						'linkOptions' => ['data-method' => 'post']],
				],
				'encode' => false,
			] : false
		]),
	]);
	NavBar::end();
	?>

	<div class="container">
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; <?=Yii::$app->params['authorBlog'].' '.date('Y') ?></p>

		<p class="pull-right"><?= Yii::powered() ?></p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
