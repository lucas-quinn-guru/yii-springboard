<?php
namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Class RbacAsset
 *
 * @package yii2mod\rbac
 */
class CategoryAsset extends AssetBundle
{
	// finally your files..
	public $css = [
		'js/jstree/dist/themes/default/style.min.css',
	];
	public $js = [
		'js/jstree/dist/jstree.min.js',
		'js/jquery.slugify.js',
	];
	// that are the dependecies, for makeing your Asset bundle work with Yii2 framework
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];
}