<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Nav;
use app\modules\admin\assets\ModuleAsset;
use app\components\widgets\Alert;
use app\modules\admin\Module as AdminModule;
use app\modules\user\Module as UserModule;

/** @var \yii\web\Controller $context */
$context = $this->context;

$bundle = ModuleAsset::register($this);
$this->registerJsFile($bundle->baseUrl.'/js/script.js', ['depends'=>'yii\web\JqueryAsset']);
$this->registerCssFile($bundle->baseUrl.'/css/style.css', ['depends'=>'app\assets\AppAsset']);

if (!empty($this->params['breadcrumbs']))
{
	array_unshift($this->params['breadcrumbs'], ['label' => AdminModule::t('module', 'ADMIN'),
		'url' => ['/admin/default/index']]);
}
else
{
	$this->params['breadcrumbs'][] = AdminModule::t('module', 'ADMIN');
}
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>

	<div class="container">
		<div class="row">
			<div class="col-lg-2 admin-menu">
				<?=
				Nav::widget([
					'options' => ['class' => 'nav nav-pills nav-stacked'],
					'activateParents' => true,
					'items' =>  [
						['label' => UserModule::t('module', 'ADMIN_USERS'),
							'url' => ['/admin/user/default/index'],
							'active' => $context->module->id == 'user'],

					],
				]);
				?>
			</div>
			<div class="col-lg-10 admin-content">
				<?= Alert::widget() ?>
				<?= $content ?>
			</div>
		</div>
	</div>

<?php $this->endContent(); ?>
