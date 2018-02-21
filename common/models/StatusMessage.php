<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "status_message".
 *
 * @property int $id
 * @property string $controller Controller Name
 * @property string $action Controller Action Name
 * @property string $name
 * @property string $subject
 * @property string $body
 * @property string $description Status Message Description
 * @property string $create_at
 * @property string $updated_at
 */
class StatusMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'status_message';
    }

	/**
	 * behaviors
	 */
	public function behaviors()
	{
		return [
			'timestamp' => [
				'class' => 'yii\behaviors\TimestampBehavior',
				'attributes' => [
					ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
					ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
				],
				'value' => new Expression('NOW()'),
			],
		];
	}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['controller', 'action', 'name', 'subject', 'body', 'description'], 'required'],
            [['create_at', 'updated_at'], 'safe'],
            [['controller', 'action', 'name'], 'string', 'max' => 105],
            [['subject', 'description'], 'string', 'max' => 255],
            [['body'], 'string', 'max' => 2025],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'controller' => 'Controller Name',
            'action' => 'Action Name',
            'name' => 'Name',
            'subject' => 'Subject',
            'body' => 'Body',
            'description' => 'Description',
            'create_at' => 'Create At',
            'updated_at' => 'Updated At',
        ];
    }
}
