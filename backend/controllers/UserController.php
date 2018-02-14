<?php

namespace backend\controllers;

use Yii;
use yii\web\Response;
use common\models\User;
use backend\models\search\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\helpers\PermissionHelpers;
use backend\models\rbac\AssignmentModel;
use backend\models\rbac\search\AssignmentSearch;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
	/**
	 * @var \yii\web\IdentityInterface the class name of the [[identity]] object
	 */
	public $userIdentityClass;
	/**
	 * @var string search class name for assignments search
	 */
	public $searchClass = [
		'class' => AssignmentSearch::class,
	];
	/**
	 * @var string id column name
	 */
	public $idField = 'id';
	/**
	 * @var string username column name
	 */
	public $usernameField = 'username';
	/**
	 * @var array assignments GridView columns
	 */
	public $gridViewColumns = [];

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
					'index' => ['get'],
					'view' => ['get'],
					'assign' => ['post'],
					'remove' => ['post'],
				],
			],
			'contentNegotiator' => [
				'class' => 'yii\filters\ContentNegotiator',
				'only' => ['assign', 'remove'],
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		if ($this->userIdentityClass === null) {
			$this->userIdentityClass = Yii::$app->user->identityClass;
		}
		if( empty( $this->gridViewColumns ) )
		{
			$this->gridViewColumns = [
				$this->idField,
				$this->usernameField,
			];
		}
	}

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search( Yii::$app->request->queryParams );

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
	        'permissionModel' => $this->findPermissionModel( $id )
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

	/**
	 * Assign items
	 *
	 * @param int $id
	 *
	 * @return array
	 */
	public function actionAssign( int $id )
	{
		$items = Yii::$app->getRequest()->post('items', []);

		$assignmentModel = $this->findPermissionModel( $id );
		$assignmentModel->assign( $items );

		return $assignmentModel->getItems();
	}

	/**
	 * Remove items
	 *
	 * @param int $id
	 *
	 * @return array
	 */
	public function actionRemove(int $id)
	{
		$items = Yii::$app->getRequest()->post('items', [] );

		$assignmentModel = $this->findPermissionModel( $id );
		$assignmentModel->revoke( $items );

		return $assignmentModel->getItems();
	}

	/**
	 * Finds the Assignment model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param int $id
	 *
	 * @return AssignmentModel the loaded model
	 *
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findPermissionModel(int $id)
	{
		$class = $this->userIdentityClass;
		if( ( $user = $class::findIdentity( $id ) ) !== null )
		{
			return new AssignmentModel( $user );
		}
		throw new NotFoundHttpException('The requested page does not exist.' );
	}
}
