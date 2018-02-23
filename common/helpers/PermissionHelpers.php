<?php
namespace common\helpers;

use yii;
use yii\web\Controller;
use yii\helpers\Url;
use common\helpers\ValueHelpers;

class PermissionHelpers
{
	public static function requireUpgradeTo( $user_type_name )
	{
		if( !ValueHelpers::userTypeMatch( $user_type_name ) )
		{
			return Yii::$app->getResponse()->redirect(Url::to(['upgrade/index']));
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
	
	public static function userMustBeOwner( $model_name, $model_id )
	{
		$connection = \Yii::$app->db;
		$user_id = Yii::$app->user->identity->id;
		
		$sql = "SELECT id FROM $model_name WHERE user_id=:user_id AND id=:model_id";
		
		$command = $connection->createCommand($sql);
		$command->bindValue(":user_id", $user_id);
		$command->bindValue(":model_id", $model_id);
		
		if( $result = $command->queryOne() )
		{
			return true;
		} else
		{
			return false;
		}
	}
}