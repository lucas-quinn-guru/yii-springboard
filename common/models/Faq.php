<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "faq".
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property int $cateogry_id
 * @property int $is_featured
 * @property int $weight
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $update_by
 */
class Faq extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq';
    }

	public function behaviors() {
		return [
			'timestamp' => [
				'class' => 'yii\behaviors\TimestampBehavior',
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => [ 'created_at', 'updated_at' ],
					ActiveRecord::EVENT_BEFORE_UPDATE => [ 'updated_at' ],
				],
				'value' => new Expression( 'NOW()' ),
			],
			'blameable' => [
				'class' => BlameableBehavior::className(),
				'createdByAttribute' => 'created_by',
				'updatedByAttribute' => 'updated_by',
			],
		];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		return [
			[ [ 'question', 'answer' ], 'required' ],
			[ [ 'category_id', 'is_featured', 'weight', 'created_by', 'updated_by' ], 'integer' ],
			[ [ 'weight' ],'in', 'range'=>range(1,100 ) ],
			[ 'weight', 'default', 'value' => 100 ],
			[ [ 'question' ], 'string', 'max' => 255 ],
			[ [ 'question' ], 'unique' ],
			[ [ 'answer' ], 'string', 'max' => 1055 ],
			[ [ 'created_at', 'updated_at' ], 'safe' ]
		];
	}

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question' => 'Question',
            'answer' => 'Answer',
            'cateogry_id' => 'Cateogry ID',
            'is_featured' => 'Is Featured',
            'weight' => 'Weight',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'update_by' => 'Update By',
        ];
    }
	
	public function getCategory()
	{
		return $this->hasOne( Faq::className(), [ 'id' => 'category_id' ] );
	}

	/**
	 * usess magic getFaqCategoryName on return statement
	 *
	 */
	public function getFaqCategoryName()
	{
		return $this->faqCategory->name;
	}


	/**
	 * get list of FaqCategory for dropdown
	 */
	public static function getFaqCategoryList()
	{
		$droptions = FaqCategory::find()->asArray()->all();
		return Arrayhelper::map( $droptions, 'id', 'name' );
	}

	public static function getFaqIsFeaturedList()
	{
		return $droptions = [0 => "no", 1 => "yes"];
	}

	public function getFaqIsFeaturedName()
	{
		return $this->is_featured == 0 ? "no" : "yes";
	}

	public function getCreatedByUser()
	{
		return $this->hasOne( User::className(), [ 'id' => 'created_by' ] );
	}

	/**
	 * @getCreateUserName
	 *
	 */
	public function getCreatedByUsername()
	{
		return $this->createdByUser ?
			$this->createdByUser->username : '- no user -';
	}

	public function getUpdatedByUser()
	{
		return $this->hasOne(User::className(), ['id' => 'updated_by']);
	}

	/**
	 * @getUpdateUserName
	 *
	 */
	public function getUpdatedByUsername()
	{
		return $this->updatedByUser ?
			$this->updatedByUser->username : '- no user -';
	}

}
