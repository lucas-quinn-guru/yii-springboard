<?php

namespace backend\controllers;

use Yii;
use backend\models\forms\RoleForm;
use backend\models\search\RoleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\PermissionHelpers;
use yii\data\ArrayDataProvider;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
{
    /**
     * @inheritdoc
     */
	public function behaviors()
	{
		return [
			
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'only' => ['index', 'view','create', 'update', 'delete'],
				'rules' => [
					[
						'actions' => ['index', 'create', 'view',],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							return PermissionHelpers::requireMinimumRole('Admin')
								&& PermissionHelpers::requireStatus('Active');
						}
					],
					[
						'actions' => [ 'update', 'delete'],
						'allow' => true,
						'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
							return PermissionHelpers::requireMinimumRole('SuperUser')
								&& PermissionHelpers::requireStatus('Active');
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

    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
    	/*
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    	*/
	
		$auth = Yii::$app->authManager;
		
		$roles = $auth->getRoles();
		
		echo print_r( $roles, true );
		exit;
	
		$datProvider = new ArrayDataProvider([
			'allModels' => $roles,
			'pagination' => [
				'pageSize' => 10,
			],
			'sort' => [
				//'attributes' => ['id', 'name'],
			],
		]);
		
    	return $this->render( 'index', [
			'dataProvider' => $datProvider
		] );
    }

    /**
     * Displays a single Role model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		$auth = Yii::$app->authManager;
		
        $model = new RoleForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'name' => $model->name]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
