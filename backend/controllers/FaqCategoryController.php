<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\search\FaqCategorySearch;
use common\models\FaqCategory;
use common\helpers\PermissionHelpers;

/**
 * FaqCategoryController implements the CRUD actions for FaqCategory model.
 */
class FaqCategoryController extends Controller
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
						'actions' => [ 'index', 'view', 'create', 'update', 'delete' ],
						'allow' => true,
						'roles' => [ '@' ],
						'matchCallback' => function ($rule, $action)
						{
							return Yii::$app->user->can('Admin')
								   && PermissionHelpers::requireStatus('Active');
						}
					],
				],
			],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'post' ],
                ],
            ],
        ];
    }

    /**
     * Lists all FaqCategory models.
	 * @throws
     * @return mixed
     */
    public function actionIndex()
    {
		$model = new FaqCategory();
	
		$parentCategory = false;
	
		if( Yii::$app->request->getQueryParam('id' ) != "" )
		{
			$model  = $this->findModel( Yii::$app->request->getQueryParam('id' ) );
		}
	
		if( Yii::$app->request->getQueryParam('parent_id' ) != "" )
		{
			$model->parent_id = Yii::$app->request->getQueryParam('parent_id' );
			$parentCategory = $this->findModel( $model->parent_id );
		}
		
		if( $model->load( Yii::$app->request->post() ) )
		{
			$model->save();
			$model->upload();
			if( $model->isNewRecord )
			{
				Yii::$app->getSession()->setFlash('success', 'Category information has been stored.' );
				return $this->redirect( [ 'index' ] );
			} else
			{
				Yii::$app->getSession()->setFlash('success', 'Category information updated successfully.' );
				$this->refresh();
			}
		}
		
		return $this->render('index', [
			'model' => $model,
			'parentCategory' => $parentCategory
		] );
    }

    /**
     * Displays a single FaqCategory model.
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
     * Creates a new FaqCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FaqCategory();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FaqCategory model.
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
     * Deletes an existing FaqCategory model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FaqCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FaqCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FaqCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
