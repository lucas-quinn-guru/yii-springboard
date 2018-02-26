<?php

use yii\db\Migration;

/**
 * Handles the creation of table `faq_category`.
 */
class m180226_001317_create_faq_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('faq_category', [
            'id' => $this->primaryKey(),
			'name' => $this->string( 45 ),
			'weight' => $this->integer(),
			'is_featured' => $this->boolean(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('faq_category');
    }
}
