<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-default-view">

	<p>
		<?= Html::a(Module::t('module', 'BUTTON_UPDATE'), ['update', 'id' => $model->id],
			['class' => 'btn btn-primary']) ?>
		<?= Html::a(Module::t('module', 'BUTTON_DELETE'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Module::t('module', 'CONFIRM_DELETE'),
				'method' => 'post',
			],
		]) ?>
	</p>

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'username',
			'email:email',
			'created_at:datetime',
			'updated_at:datetime',
			[
				'attribute' => 'status',
				'value' => $model->getStatusName(),
			],
			[
				'attribute' => 'role',
				'value' => ($role = Yii::$app->authManager->getRole($model->role)) ?
					$role->description : $model->role,
			],
		],
	]) ?>

</div>
