<?php
namespace console\controllers;

use yii\console\Controller;

/**
 * This command runs PHP built in web server
 *
 * @author Headshaker
 */
class ServerController extends Controller
{
	/**
	 * This command echoes what you have entered as the message.
	 * @param string $root web root location relative to Yii app root.
	 * @param string $host hostname of the server.
	 * @param string $port port to listen for connections.
	 */
	public function actionIndex( $root = "web", $host = "localhost", $port = 8080 )
	{
		$basePath = \Yii::$app->basePath;
		
		$webRoot = $basePath . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . $root . DIRECTORY_SEPARATOR . "web";
		
		echo "Yii dev server started on http://{$host}:{$port}/\n";
		echo "Document root is \"{$webRoot}\"\n";
		
		passthru('"'.PHP_BINARY.'"'." -S {$host}:{$port} -t \"{$webRoot}\"")."\n";
	}
}