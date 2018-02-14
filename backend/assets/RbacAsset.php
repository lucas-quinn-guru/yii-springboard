<?php
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class RbacAsset
 *
 * @package yii2mod\rbac
 */
class RbacAsset extends AssetBundle
{
	/**
	 * @var array
	 */
	public $js = [
		'js/rbac.js',
	];
	public $css = [
		'css/rbac.css',
	];
	/**
	 * @var array
	 */
	public $depends = [
		'yii\web\YiiAsset',
	];
}