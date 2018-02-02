<?php

namespace common\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $role_name
 * @property int $role_value
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_name', 'role_value'], 'required'],
            [['role_value'], 'integer'],
            [['role_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_name' => 'Role Name',
            'role_value' => 'Role Value',
        ];
    }
    
    public function getUsers()
	{
		//return $this->hasMany( User::className(), [ 'role_id'=>'id' ] );
		
		return $this->hasMany( User::className(), [ 'id'=>'user_id' ] )
			->viaTable( 'role_user', [ 'role_id' => 'id' ] );
		
		//The following comes from the User Model as an example
		//return $this->hasMany( Role::className(), [ 'id' => 'role_id' ] )
		//	->viaTable( 'role_user', [ 'user_id' => 'id' ] );
	}
}
