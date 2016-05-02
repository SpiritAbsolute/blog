<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\frontend\form\PasswordResetForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;

$this->title = Module::t('module', 'TITLE_PASSWORD_CHANGE');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-frontend-default-password-reset">

	<p><?= Module::t('module', 'PLEASE_FILL_FOR_RESET') ?></p>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'password-reset-form']); ?>

				<?= $form->field($model, 'password')
					->passwordInput(['autofocus' => true]) ?>

				<div class="form-group">
					<?= Html::submitButton(Module::t('module', 'BUTTON_SAVE'),
						['class' => 'btn btn-primary']) ?>
				</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
