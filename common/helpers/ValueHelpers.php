<?php
/**
 * Created by PhpStorm.
 * User: mbarrus
 * Date: 2/3/18
 * Time: 7:15 AM
 */

namespace common\helpers;

use yii;
use common\models\Role;
use common\models\Status;
use common\models\UserType;
use common\models\User;
use yii\helpers\ArrayHelper;


class ValueHelpers
{

	public static function roleMatch( $role_name )
	{
		$userRoles = Yii::$app->user->identity->roleList;

		if( in_array( $role_name, $userRoles ) )
		{
			return true;
		}
		return false;

	}


	public static function getUsersRoleValues( $userId=null )
	{
		if( $userId == null )
		{
			$userRoles = Yii::$app->user->identity->roleList;

			$userRoleValues = ArrayHelper::getColumn( $userRoles, 'role_id' );

			return isset( $userRoleValues ) && count( $userRoleValues ) > 0 ? $userRoleValues : false;
		} else
		{
			$user = User::findOne( $userId );
			$userRoles = $user->getRoleList;
			$userRoleValues = ArrayHelper::getColumn( $userRoles, 'role_id' );


			return isset( $userRoleValues ) && count( $userRoleValues ) > 0 ? $userRoleValues : false;
		}


	}

	public static function getRoleValue( $role_name )
	{
		$role = Role::find( 'role_value' )
			->where(['role_name' => $role_name])
			->one();

		return isset( $role->role_value) ? $role->role_value : false;
	}

	public static function isRoleNameValid( $role_name )
	{
		$role = Role::find( 'role_name' )
			->where( [ 'role_name' => $role_name ] )
			->one();

		return isset( $role->role_name ) ? true : false;
	}

	public static function statusMatch( $status_name )
	{
		$userHasStatusName = Yii::$app->user->identity->status->status_name;

		return $userHasStatusName == $status_name ? true : false;
	}

	public static function getStatusId( $status_name )
	{
		$status = Status::find( 'id' )
			->where( [ 'status_name'=>$status_name ] )
			->one();

		return isset( $status->id) ? $status->id : false;
	}

	public static function userTypeMatch( $user_type_name )
	{
		$userHasUserTypeName = Yii::$app->user->identity->userType->user_type_name;

		return $userHasUserTypeName == $user_type_name ? true : false;
	}

}