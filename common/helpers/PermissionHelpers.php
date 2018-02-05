<?php

namespace common\helpers;

use common\helpers\ValueHelpers;
use yii;
use yii\web\Controller;
use yii\helpers\Url;

class PermissionHelpers
{
	public static function requireUpgradeTo( $user_type_name )
	{
		if( ValueHelpers::userTypeMatch( $user_type_name ) )
		{
			return Yii::$app->getResponse()->redirect( Url::to( [ 'upgrade/index' ] ) );
		}
	}

	public static function requireStatus( $status_name )
	{
		return ValueHelpers::statusMatch( $status_name );
	}

	public static function requireRole( $role_name )
	{
		return ValueHelpers::roleMatch( $role_name );
	}

	public static function requireMinimumRole( $role_name, $userId = null )
	{
		if( ValueHelpers::isRoleNameValid( $role_name ) )
		{
			if( $userId == null )
			{
				$usersRoleValues = ValueHelpers::getUsersRoleValues();
			} else
			{
				$usersRoleValues = ValueHelpers::getUsersRoleValues($userId);
			}

			$max_role_value = 0;
			foreach( $usersRoleValues as $roleValues )
			{
				if( $roleValues[ ''])
			}

			return $usersRoleValues >= ValueHelpers::getRoleValue($role_name) ? true : false;
		} else
		{
			return false;
		}
	}
}