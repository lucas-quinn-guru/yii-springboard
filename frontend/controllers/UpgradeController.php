<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\PermissionHelpers;
use common\helpers\RecordHelpers;
use common\models\Profile;

class UpgradeController extends Controller
{
	
	public function behaviors()
	{
		return [
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['index'],
				'rules' => [
					[
						'actions' => ['index'],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							return PermissionHelpers::requireStatus('Active');
						}
					],
				
				],
			],
			
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}
	
	public function actionIndex()
    {
		$name = Profile::find()->where( [ 'user_id' =>
											Yii::$app->user->identity->id ] )->one();
        return $this->render('index', [ 'name'=>$name ] );
    }

}
