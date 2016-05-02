<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\frontend\form\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\modules\user\Module;

$this->title = Module::t('module', 'TITLE_PASSWORD_RESET');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-frontend-default-password-reset-request">
	<p><?= Module::t('module', 'PLEASE_FILL_FOR_RESET_REQUEST') ?></p>

	<div class="row">
		<div class="col-lg-5">
			<?php $form = ActiveForm::begin(['id' => 'password-reset-request-form']); ?>

				<?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

				<div class="form-group">
					<?= Html::submitButton(Module::t('module', 'BUTTON_SEND'),
						['class' => 'btn btn-primary']) ?>
				</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
