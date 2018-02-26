<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faq_category".
 *
 * @property int $id
 * @property string $name
 * @property int $weight
 * @property int $is_featured
 */
class FaqCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faq_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
		return [
			[ [ 'name' ], 'required' ],
			[ [ 'name' ], 'string', 'max' => 45 ],
			[ [ 'weight', 'is_featured' ], 'integer' ],
			[ 'weight', 'default', 'value' => 100 ],
			[ [ 'weight' ], 'in', 'range'=>range(1,100 ) ]
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'weight' => 'Weight',
            'is_featured' => 'Is Featured',
        ];
    }
	
	public function getFaqs()
	{
		return $this->hasMany( Faq::className(), [ 'category_id' => 'id' ] );
	}
	
	public static function getFaqCategoryIsFeaturedList()
	{
		return $droptions = [ 0 => "no", 1 => "yes" ];
    }
}
