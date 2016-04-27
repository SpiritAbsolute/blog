<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('app', 'TITLE_PROFILE_UPDATE');
$this->params['breadcrumbs'][] = [
	'label' => Yii::t('app', 'TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-update">

	<div class="user-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'),
				['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>