<?php
namespace common\helpers;

use yii;
use common\models\Role;
use common\models\Status;
use common\models\UserType;
use common\models\User;

class ValueHelpers
{
	public static function roleMatch( $role_name )
	{
		return Yii::$app->user->can( $role_name ) ? true : false;
	}
	
	
	public static function isRoleNameValid( $role_name )
	{
		$auth = Yii::$app->authManager;
		$role = $auth->getRole( $role_name );
		
		return $role != null ? true : false;
	}
	
	public static function statusMatch($status_name)
	{
		$userHasStatusName = Yii::$app->user->identity->status->status_name;
		
		return $userHasStatusName == $status_name ? true : false;
	}
	
	public static function getStatusId( $status_name )
	{
		$status = Status::find( 'id' )
						->where( [ 'status_name' => $status_name ] )
						->one();
		
		return isset( $status->id ) ? $status->id : false;
	}
	
	public static function userTypeMatch( $user_type_name )
	{
		$userHasUserTypeName = Yii::$app->user->identity->userType->user_type_name;
		
		return $userHasUserTypeName == $user_type_name ? true : false;
	}
}