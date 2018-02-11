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
				$usersRoleValues = ValueHelpers::getUsersRoleValues( $userId );
			}

			$max_role_value = 0;
			foreach( $usersRoleValues as $roleValues )
			{
				if( $roleValues[ 'role_value' ] > $max_role_value )
				{
					$max_role_value = $roleValues[ 'role_value' ];
				}
			}

			return $max_role_value >= ValueHelpers::getRoleValue( $role_name ) ? true : false;
		} else
		{
			return false;
		}
	}

	public static function userMustBeOwner( $model_name, $model_id )
	{
		$connection = \Yii::$app->db;

		$userId = Yii::$app->user->identity->id;

		$sql = "SELECT id FROM $model_name 
					WHERE user_id=:userId AND id=:model_id";

		$command = $connection->createCommand( $sql );
		$command->bindValue( ":userId", $userId );
		$command->bindValue( ":model_id", $model_id );

		if( $result = $command->queryOne() )
		{
			return true;
		}

		return false;
	}
}