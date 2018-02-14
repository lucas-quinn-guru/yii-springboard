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
    public $name;
    public $description;
    public $name_original;
  
    private $_role;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [ [ 'name' ], 'required' ],
        ];
    }
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'name' => 'Role Name',
			'description' => 'Description',
		];
	}
	
	/**
	 * Adds a role.
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
		$authRole = $auth->createRole( $this->name );
		$authRole->description = $this->description;
		
		$auth->add( $authRole );
		return true;
	}
	
	/**
	 * Updates a role.
	 *
	 * @return boolean the saved model or null if saving fails
	 * @throws
	 */
	public function update()
	{
		if( !$this->validate() )
		{
			return null;
		}
		
		$auth = Yii::$app->authManager;
		$authRole = $auth->createRole( $this->name );
		$authRole->description = $this->description;
		
		$auth->update( $this->name_original, $authRole );
		
		$auth->add( $authRole );
		return true;
	}
}
