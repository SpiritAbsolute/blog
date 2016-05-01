<?php
use app\modules\admin\Module;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Module::t('module', 'TITLE_CREATE');
$this->params['breadcrumbs'][] = ['label' =>
	Module::t('module', 'ADMIN'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('module', 'ADMIN_USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
