<?php

namespace backend\models\forms;

use Yii;
use yii\base\Model;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\helpers\PermissionHelpers;


/**
 * Login form
 */
class RoleForm extends Model
{
    public $role;
    public $description;
  
    private $_role;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [ [ 'role' ], 'required' ],
        ];
    }
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'role' => 'Role Name',
		];
	}
	
	/**
	 * Signs user up.
	 *
	 * @return boolean the saved model or null if saving fails
	 * @throws
	 */
	public function save()
	{
		if( !$this->validate() )
		{
			return null;
		}
		
		$auth = Yii::$app->authManager;
		$authRole = $auth->createRole( $this->role );
		$authRole->description = $this->description;
		
		$auth->add( $authRole );
		return true;
	}
}
