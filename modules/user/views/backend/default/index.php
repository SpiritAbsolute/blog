<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\user\models\backend\User;
use app\components\grid\ActionColumn;
use app\components\grid\SetColumn;
use app\components\grid\LinkColumn;
use kartik\date\DatePicker;
use app\modules\user\Module;
use yii\helpers\ArrayHelper;
use app\modules\user\widgets\backend\grid\RoleColumn;

/* @var $this yii\web\View */
/* @var $searchModel \app\modules\user\models\backend\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('module', 'ADMIN_USERS');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-default-index">

	<p>
		<?= Html::a(Module::t('module', 'BUTTON_CREATE'), ['create'],
			['class' => 'btn btn-success']) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			'id',
			[
				'filter' => DatePicker::widget([
					'model' => $searchModel,
					'attribute' => 'date_from',
					'attribute2' => 'date_to',
					'type' => DatePicker::TYPE_RANGE,
					'separator' => '-',
					'pluginOptions' => ['format' => 'dd.mm.yyyy']
				]),
				'attribute' => 'created_at',
				'format' => 'datetime',
			],
			[
				'class' => LinkColumn::className(),
				'attribute' => 'username',
			],
			'email:email',
			[
				'class' => SetColumn::className(),
				'filter' => User::getStatusesArray(),
				'attribute' => 'status',
				'name' => 'statusName',
				'cssCLasses' => [
					User::STATUS_ACTIVE => 'success',
					User::STATUS_WAIT => 'warning',
					User::STATUS_BLOCKED => 'default',
				],
			],

			[
				'class' => RoleColumn::className(),
				'filter' => ArrayHelper::map(
					Yii::$app->authManager->getRoles(), 'name', 'description'),
				'attribute' => 'role',
			],

			['class' => ActionColumn::className()],
		],
	]); ?>
</div>
