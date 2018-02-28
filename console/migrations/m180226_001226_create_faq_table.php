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
			'category_id' => $this->integer(),
			'question' => $this->string( 255 )->notNull(),
			'slug' => $this->string( 255 )->notNull(),
			'answer' => $this->string( 1055 )->notNull(),
			'image' => $this->string( 80 )->null(),
			'meta_title' => $this->string( 80 )->null(),
			'meta_keywords' => $this->string( 150 )->null(),
			'meta_description' => $this->string( 255 )->null(),
			'position' => $this->smallInteger()->unsigned()->null()->defaultValue( 100 ),
			'is_featured' => $this->boolean()->defaultValue( 0 ),
			'is_active' => $this->boolean()->defaultValue( 1 ),
			'created_by' => $this->integer(),
			'updated_by' => $this->integer(),
			'created_at' => $this->dateTime(),
			'updated_at' => $this->dateTime()
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
