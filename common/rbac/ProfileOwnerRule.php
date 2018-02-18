<?php

namespace common\rbac;

use yii\rbac\Rule;
use common\models\Profile;

/**
* Checks if authorID matches user passed via params
*/
class ProfileOwnerRule extends Rule
{
	public $name = 'isProfileOwner';

	/**
	* @param string|int $user the user ID.
	* @param Item $item the role or permission that this rule is associated with
	* @param array $params parameters passed to ManagerInterface::checkAccess().
	* @return bool a value indicating whether the rule permits the role or permission it is associated with.
	*/
	public function execute( $user, $item, $params )
	{
		return isset( $params[ 'profile' ] ) ? $params[ 'profile' ]->user_id == $user : false;
	}
}