<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\modules\user\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Module::t('module', 'TITLE_PROFILE_UPDATE');
$this->params['breadcrumbs'][] = [
	'label' => Module::t('module', 'TITLE_PROFILE'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-update">

	<div class="user-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

		<div class="form-group">
			<?= Html::submitButton(Module::t('module', 'BUTTON_SAVE'),
				['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div>

</div>