<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use common\models\User;


/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthdate
 * @property int $gender_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Gender $gender
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile';
    }
    
    public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => 'yii\behaviors\TimestampBehavior',
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => [ 'created_at', 'updated_at' ],
					ActiveRecord::EVENT_BEFORE_UPDATE => [ 'updated_at' ]
				],
				'value' => new Expression( 'NOW()' ),
			],
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [ [ 'user_id', 'gender_id' ], 'required' ],
            [ [ 'user_id', 'gender_id' ], 'integer' ],
			
            [ [ 'birthdate', 'created_at', 'updated_at' ], 'safe' ],
			[ [ 'birthdate' ], 'date', 'format'=>'php:Y-m-d' ],
			
            [ [ 'first_name', 'last_name' ], 'string', 'max' => 60 ],
			
			[ [ 'gender_id' ], 'in', 'range'=>array_keys( self::getGenderList() ) ],
            [ [ 'gender_id' ], 'exist', 'skipOnError' => true, 'targetClass' => Gender::className(), 'targetAttribute' => [ 'gender_id' => 'id' ] ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'birthdate' => 'Birthdate',
            'gender_id' => 'Gender ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
			'genderName'=> Yii::t( 'app', 'Gender' ),
			'userLink'=>Yii::t( 'app', 'User' ),
			'profileIdLink'=>Yii::t( 'app', 'Profile' )
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGender()
    {
        return $this->hasOne( Gender::className(), [ 'id' => 'gender_id' ] );
    }
	
	/**
	 * Get the gender name of the given gender id within profile
	 *
	 * @return string
	 */
    public function getGenderName()
	{
		return $this->gender->gender_name;
	}
	
	/**
	 * Get list of genders for dropdown
	 *
	 * @return array
	 */
    public static function getGenderList()
	{
		$droptions = Gender::find()->asArray()->all();
		return ArrayHelper::map( $droptions, 'id', 'gender_name' );
	}
	
	/**
	 * Get user that belongs to this profile
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne( User::className(), [ 'id' => 'user_id' ] );
	}
	
	/**
	 * Get username of user that belongs to this profile.
	 *
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->user->username;
	}
	
	/**
	 * Get user id that belongs to this profile if user object exists.
	 *
	 * @return string
	 */
	public function getUserId()
	{
		return $this->user ? $this->user->id : 'none';
	}
	
	/**
	 * Get the user link in html format to view the user.
	 *
	 * @return string
	 */
	public function getUserLink()
	{
		$url = Url::to( [ 'user/view', 'id'=>$this->UserId ] );
		$options = [];
		return Html::a( $this->getUserName(), $url, $options );
	}
	
	/**
	 * Get the profile link to the profile of the user in HTML format
	 *
	 * @return string
	 */
	public function getProfileIdLink()
	{
		$url = Url::to( [ 'profile/update', 'id'=>$this->id ] );
		$options = [];
		return Html::a( $this->id, $url, $options );
	}
	
	
}
