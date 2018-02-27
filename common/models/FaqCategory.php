<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "faq_category".
 *
 * @property int $id
 * @property int $parent_id Parent category
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $image
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property int $position
 * @property int $is_featured
 * @property int $is_active
 * @property string $created_at
 * @property string $update_at
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
            [['parent_id', 'position', 'is_featured', 'is_active'], 'integer'],
            [['name', 'slug'], 'required'],
            [['description'], 'string'],
            [['created_at', 'update_at'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 45],
            [['image', 'meta_title'], 'string', 'max' => 80],
            [['meta_keywords'], 'string', 'max' => 150],
            [['meta_description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'image' => 'Image',
            'meta_title' => 'Meta Title',
            'meta_keywords' => 'Meta Keywords',
            'meta_description' => 'Meta Description',
            'position' => 'Position',
            'is_featured' => 'Is Featured',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }
}
