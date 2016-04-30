<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' =>
	Yii::t('app', 'ADMIN'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN_USERS'),
	'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username,
	'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'TITLE_UPDATE');
?>
<div class="user-update">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>

</div>
