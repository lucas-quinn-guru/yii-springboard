<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_type`.
 */
class m180131_061213_create_user_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_type', [
            'id' => $this->primaryKey()->unsigned(),
			'user_type_name' => $this->string( 45 )->notNull(),
			'user_type_value' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user_type');
    }
}
