<?php
namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class ModuleAsset extends AssetBundle
{
	public $sourcePath = '@app/modules/admin/assets';
	public $css = [
		'css/style.css',
	];
	public $js = [
		'js/script.js',
	];
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}
