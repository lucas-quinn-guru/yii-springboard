<?php

namespace common\helpers;

use Yii;
use common\models\StatusMessage;

class RecordHelpers
{
	public static function userHas( $model_name )
	{
		$connection = \Yii::$app->db;

		$userid = Yii::$app->user->identity->id;

		$sql = "SELECT id FROM $model_name WHERE user_id=:userid";

		$command = $connection->createCommand( $sql );
		$command->bindValue(":userid", $userid );

		$result = $command->queryOne();

		if( $result == null )
		{
			return false;
		} else
		{
			return $result[ 'id' ];
		}
	}

	public static function findStatusMessage( $action_name, $controller_name )
	{
		$result =  StatusMessage::find()
			->select([ 'id' ] )
			->where( [ 'action' => $action_name ] )
			->andWhere( [ 'controller' => $controller_name ] )
			->one();

		return isset( $result[ 'id' ] ) ? $result[ 'id' ] : false;
	}

	public static function getMessageSubject( $id )
	{
		$result =  StatusMessage::find()
			->select( [ 'subject' ] )
			->where( [ 'id' => $id ] )
			->one();

		return isset( $result[ 'subject' ] ) ? $result[ 'subject' ] : false;
	}

	public static function getMessageBody( $id )
	{
		$result = StatusMessage::find()
			->select( [ 'body' ] )
			->where( [ 'id' => $id ] )
			->one();

		return isset( $result[ 'body' ] ) ? $result[ 'body' ] : false;
	}
}