<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\frontend\form\PasswordChangeForm */

$this->title = Module::t('module', 'TITLE_PASSWORD_CHANGE');
$this->params['breadcrumbs'][] = [
	'label' => Module::t('module', 'TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-frontend-profile-password-change">

	<div class="user-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'currentPassword')
			->passwordInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'newPassword')
			->passwordInput(['maxlength' => true]) ?>
		<?= $form->field($model, 'newPasswordRepeat')
			->passwordInput(['maxlength' => true]) ?>

		<div class="form-group">
			<?= Html::submitButton(Module::t('module', 'BUTTON_SAVE'),
				['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>