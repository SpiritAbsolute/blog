<?php
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' =>
	Module::t('module', 'ADMIN'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_USERS'),
	'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username,
	'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Module::t('module', 'TITLE_UPDATE');
?>
<div class="user-update">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
