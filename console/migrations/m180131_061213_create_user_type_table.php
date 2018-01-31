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
            'id' => $this->primaryKey(),
			'user_type_name' => $this->string( 45 ),
			'user_type_value' => $this->integer()
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