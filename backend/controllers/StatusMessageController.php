<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use backend\models\search\StatusMessageSearch;
use common\helpers\PermissionHelpers;
use common\models\StatusMessage;

/**
 * StatusMessageController implements the CRUD actions for StatusMessage model.
 */
class StatusMessageController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
	        'access' => [
		        'class' => AccessControl::className(),
		        'rules' => [
			        [
				        'actions' => [ 'index', 'create', 'update', 'view' ],
				        'allow' => true,
				        'roles' => ['@'],
				        'matchCallback' => function ($rule, $action) {
					        return Yii::$app->user->can('Admin')
						        && PermissionHelpers::requireStatus('Active');
				        }
			        ],
			        [
				        'actions' => [ 'delete' ],
				        'allow' => true,
				        'roles' => ['@'],
				        'matchCallback' => function ($rule, $action) {
					        return Yii::$app->user->can('SuperUser')
						        && PermissionHelpers::requireStatus('Active');
				        }
			        ]
		        ],
	        ],
        	'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all StatusMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StatusMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StatusMessage model.
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
     * Creates a new StatusMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StatusMessage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StatusMessage model.
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
     * Deletes an existing StatusMessage model.
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
     * Finds the StatusMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StatusMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StatusMessage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
