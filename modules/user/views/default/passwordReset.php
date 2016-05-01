<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\modules\user\models\form\PasswordResetForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'TITLE_PASSWORD_CHANGE');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-password-reset">

    <p><?= Yii::t('app', 'PLEASE_FILL_FOR_RESET') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'password-reset-form']); ?>

                <?= $form->field($model, 'password')
                    ->passwordInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'BUTTON_SAVE'),
                        ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
