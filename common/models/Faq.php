<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faq".
 *
 * @property int $id
 * @property int $category_id
 * @property string $question
 * @property string $slug
 * @property string $answer
 * @property string $image
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property int $position
 * @property int $is_featured
 * @property int $is_active
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'position', 'is_featured', 'is_active', 'created_by', 'updated_by'], 'integer'],
            [['question', 'slug', 'answer'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['question', 'slug', 'meta_description'], 'string', 'max' => 255],
            [['answer'], 'string', 'max' => 1055],
            [['image', 'meta_title'], 'string', 'max' => 80],
            [['meta_keywords'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'question' => 'Question',
            'slug' => 'Slug',
            'answer' => 'Answer',
            'image' => 'Image',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'position' => 'Position',
            'is_featured' => 'Is Featured',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

	public function getFaqs()
	{
		return $this->hasMany( Faq::className(), [ 'faq_category_id' => 'id' ] );
    }
}
