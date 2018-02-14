<?php

namespace backend\controllers;

use yii\rbac\Item;
use backend\controllers\RbacItemController;

/**
 * Class PermissionController
 *
 * @package yii2mod\rbac\controllers
 */
class PermissionController extends RbacItemController
{
	/**
	 * @var int
	 */
	protected $type = Item::TYPE_PERMISSION;
	/**
	 * @var array
	 */
	protected $labels = [
		'Item' => 'Permission',
		'Items' => 'Permissions',
	];
}