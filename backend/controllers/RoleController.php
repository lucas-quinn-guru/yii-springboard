<?php
namespace backend\controllers;

use yii\rbac\Item;
use backend\controllers\RbacItemController;
/**
 * Class RoleController
 */
class RoleController extends RbacItemController
{
	/**
	 * @var int
	 */
	protected $type = Item::TYPE_ROLE;
	/**
	 * @var array
	 */
	protected $labels = [
		'Item' => 'Role',
		'Items' => 'Roles',
	];
}