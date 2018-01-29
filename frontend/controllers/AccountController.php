<?php

namespace frontend\controllers;

use yii\filters\AccessControl;

class AccountController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['index', 'update'],
				'rules' => [
					//[
					//	'allow' => true,
					//	'actions' => ['login', 'signup'],
					//	'roles' => ['?'],
					//],
					[
						'allow' => true,
						'actions' => ['index', 'update'],
						'roles' => ['@'],
					],
				],
			],
		];
	}
	
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

}
