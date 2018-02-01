<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m180131_061008_create_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('status', [
            'id' => $this->primaryKey(),
			'status_name' => $this->string( 45 )->notNull(),
			'status_value' => $this->integer( 11 )->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('status');
    }
}
