<?php

namespace common\models;

use Yii;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question', 'answer'], 'required'],
            [['cateogry_id', 'is_featured', 'weight', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'update_by'], 'safe'],
            [['question'], 'string', 'max' => 255],
            [['answer'], 'string', 'max' => 1055],
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
}
