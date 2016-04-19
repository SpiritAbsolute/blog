<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(
    ['user/default/password-reset', 'token' => $user->password_reset_token]);
?>

<?= Yii::t('module', 'HELLO {username}', ['username' => $user->username]); ?>

<?= Yii::t('module', 'FOLLOW_TO_RESET_PASSWORD') ?>

<?= Html::a(Html::encode($resetLink), $resetLink) ?>