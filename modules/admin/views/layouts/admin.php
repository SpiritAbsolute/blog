<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Nav;
use app\modules\admin\assets\ModuleAsset;
use app\components\widgets\Alert;
use yii\widgets\Breadcrumbs;

$bundle = ModuleAsset::register($this);
$this->registerJsFile($bundle->baseUrl.'/js/script.js', ['depends'=>'yii\web\JqueryAsset']);
$this->registerCssFile($bundle->baseUrl.'/css/style.css', ['depends'=>'app\assets\AppAsset']);
?>

<?php $this->beginContent('@app/views/layouts/main.php'); ?>


	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<?= Breadcrumbs::widget([
					'links' => isset($this->params['breadcrumbs'])
						? $this->params['breadcrumbs'] : [],
				]) ?>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-lg-2 admin-menu">
				<?=
				Nav::widget([
					'options' => ['class' => 'nav nav-pills nav-stacked'],
					'activateParents' => true,
					'items' =>  [
						['label' => Yii::t('app', 'ADMIN_USERS'),
							'url' => ['/admin/user/index']],

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
