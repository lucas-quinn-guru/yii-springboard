<?php

use yii\db\Migration;

/**
 * Handles the creation of table `faq`.
 */
class m180226_001226_create_faq_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('faq', [
            'id' => $this->primaryKey(),
			'question' => $this->string( 255 )->notNull(),
			'answer' => $this->string( 1055 )->notNull(),
			'cateogry_id' => $this->integer(),
			'is_featured' => $this->boolean(),
			'weight' => $this->integer()->defaultValue( 100 ),
			'created_by' => $this->integer(),
			'updated_by' => $this->integer(),
			'created_at' => $this->dateTime(),
			'update_by' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('faq');
    }
}
