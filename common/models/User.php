<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\IdentityInterface;
use yii\helpers\Security;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role_id
 * @property integer $status_id
 * @property integer $user_type_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
	const STATUS_ACTIVE = 1;
	
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user}}';
	}
	
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => TimestampBehavior::className(),
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => [ 'created_at', 'updated_at' ],
					ActiveRecord::EVENT_BEFORE_UPDATE => [ 'updated_at' ],
				],
				'value' => new Expression( 'NOW()' ),
			]
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[ 'status_id', 'default', 'value' => self::STATUS_ACTIVE ],
			[ [ 'status_id' ], 'in', 'range' => array_keys( self::getStatusList() ) ],
			
			[ 'role_id', 'default', 'value' => 1 ],
			[ [ 'role_id' ], 'in', 'range' => array_keys( self::getRoleList() ) ],
			
			[ 'user_type_id', 'default', 'value' => 1 ],
			[ [ 'user_type_id' ], 'in', 'range' => array_keys( self::getUserTypeList() ) ],
			
			[ 'username', 'filter', 'filter' => 'trim' ],
			[ 'username', 'required' ],
			[ 'username', 'unique' ],
			[ 'username', 'string', 'min' => 3, 'max' => 255 ],
			
			[ 'email', 'filter', 'filter' => 'trim' ],
			[ 'email', 'required' ],
			[ 'email', 'email' ],
			[ 'email', 'unique' ],
		];
	}
	
	/**
	 * Attribute labels
	 */
	public function attributeLabels()
	{
		return [
			//Your other attribute labels
			'roleName' => Yii::t( 'app', 'Role' ),
			'statusName' => Yii::t( 'app', 'Status' ),
			'profileId' => Yii::t( 'app', 'Profile' ),
			'profileLink' => Yii::t( 'app', 'Profile' ),
			'userLink' => Yii::t( 'app', 'User' ),
			'username' => Yii::t( 'app', 'User' ),
			'userTypeName' => Yii::t( 'app', 'User Type' ),
			'userTypeId' => Yii::t( 'app', 'User Type' ),
			'userIdLink' => Yii::t( 'app', 'ID' ),
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public static function findIdentity( $id )
	{
		return static::findOne( [ 'id' => $id, 'status_id' => self::STATUS_ACTIVE ] );
	}
	
	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken( $token, $type = null )
	{
		throw new NotSupportedException( '"findIdentityByAccessToken" is not implemented.' );
	}
	
	/**
	 * Finds user by username
	 *
	 * @param string $username
	 *
	 * @return static|null
	 */
	public static function findByUsername( $username )
	{
		return static::findOne( [ 'username' => $username, 'status_id' => self::STATUS_ACTIVE ] );
	}
	
	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 *
	 * @return static|null
	 */
	public static function findByPasswordResetToken( $token )
	{
		if( !static::isPasswordResetTokenValid( $token ) )
		{
			return null;
		}
		
		return static::findOne( [
			'password_reset_token' => $token,
			'status_id' => self::STATUS_ACTIVE,
		] );
	}
	
	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 *
	 * @return bool
	 */
	public static function isPasswordResetTokenValid( $token )
	{
		if( empty( $token ) )
		{
			return false;
		}
		
		$expire = Yii::$app->params[ 'user.passwordResetTokenExpire' ];
		$parts = explode( "_", $token );
		$timestamp = (int) end( $parts );
		
		return $timestamp + $expire >= time();
	}
	
	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}
	
	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}
	
	/**
	 * @inheritdoc
	 */
	public function validateAuthKey( $authKey )
	{
		return $this->getAuthKey() === $authKey;
	}
	
	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 *
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword( $password )
	{
		return Yii::$app->security->validatePassword( $password, $this->password_hash );
	}
	
	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword( $password )
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash( $password );
	}
	
	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}
	
	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}
	
	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		$this->password_reset_token = null;
	}
	
	/**
	 * Get the user status relationship
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getStatus()
	{
		return $this->hasOne( Status::className(), [ 'id' => 'status_id' ] );
	}
	
	/**
	 * Get the name of the status assigned to the user
	 *
	 * @return string
	 */
	public function getStatusName()
	{
		return $this->status ? $this->status->status_name : '- no status -';
	}
	
	/**
	 * Get the available status list
	 *
	 * @return array
	 */
	public static function getStatusList()
	{
		$droptions = Status::find()->asArray()->all();
		
		return ArrayHelper::map( $droptions, 'id', 'status_name' );
	}
	
	/**
	 * Get Profile relationship
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getProfile()
	{
		return $this->hasOne( Profile::className(), [ 'user_id' => 'id' ] );
	}
	
	/**
	 * get the profile id of the specified user.
	 *
	 * @return string
	 */
	public function getProfileId()
	{
		return $this->profile ? $this->profile->id : 'none';
	}
	
	/**
	 * get the profile link of specified user model
	 *
	 * @return string
	 */
	public function getProfileLink()
	{
		$url = Url::to( [ 'profile/view', 'id' => $this->profileId ] );
		$options = [];
		
		return Html::a( $this->profile ? 'profile' : 'none', $url, $options );
	}
	
	/**
	 * Get the user type for the specified user model
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getUserType()
	{
		return $this->hasOne( UserType::className(), [ "id", "user_type_id" ] );
	}
	
	/**
	 * Get the user type name
	 *
	 * @return string
	 */
	public function getUserTypeName()
	{
		return $this->userType ? $this->userType->user_type_name : '- no user type -';
	}
	
	/**
	 * Get an array of the user type list key value pair.  Mainly used for dropdowns
	 *
	 * @return array
	 */
	public function getUserTypeList()
	{
		$droptions = UserType::find()->asArray()->all();
		
		return ArrayHelper::map( $droptions, 'id', 'user_type_name' );
	}
	
	/**
	 * Get the user type id.
	 *
	 * @return string
	 */
	public function getUserTypeId()
	{
		return $this->userType ? $this->userType->id : 'none';
	}
	
	/**
	 * get the html link to user.
	 *
	 * @return string
	 */
	public function getUserIdLink()
	{
		$url = Url::to( [ 'user/update', 'id' => $this->id ] );
		$options = [];
		
		return Html::a( $this->id, $url, $options );
	}
	
	public function getUserLink()
	{
		$url = Url::to( [ 'user/view', 'id' => $this->id ] );
		$options = [];
		
		return Html::a( $this->username, $url, $options );
	}
	
	public function getRoles()
	{
		return $this->hasMany( Role::className(), [ 'id' => 'role_id' ] )
			->viaTable( 'role_user', [ 'user_id' => 'id' ] );
	}
	
	/**
	 * Get Role relationship
	 *
	 * @return \yii\db\ActiveQuery
	 */
	//public function getRole()
	//{
	//	return $this->hasOne( Role::className(), [ 'id'=>'role_id' ] );
	//}
	
	/**
	 * Get role name
	 *
	 * @return string
	 */
	//public function getRoleName()
	//{
	//	return $this->role ? $this->role->role_name : '- no role -';
	//}
	
	/**
	 * Get list of roles for dropdown
	 *
	 * @return array
	 */
	public static function getRoleList()
	{
		$droptions = Role::find()->asArray()->all();
		return ArrayHelper::map( $droptions, 'id', 'role_name' );
	}
	
	
}
