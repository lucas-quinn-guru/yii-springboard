<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
class m180226_213223_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
			'parent_id' => $this->integer()->unsigned()->null()->comment( "Parent category" ),
			'name' => $this->string( 45 )->notNull(),
			'slug' => $this->string( 45 )->notNull(),
			'description' => $this->text(),
			'image' => $this->string( 80 )->null(),
        	'meta_title' => $this->string( 80 )->null(),
			'meta_keywords' => $this->string( 150 )->null(),
			'meta_description' => $this->string( 255 )->null(),
			'position' => $this->smallInteger()->unsigned()->null(),
			'is_featured' => $this->boolean()->defaultValue( 0 ),
			'is_active' => $this->boolean()->defaultValue( 1 ),
			'created_at' => $this->dateTime(),
			'update_at' => $this->dateTime()
        ] );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
