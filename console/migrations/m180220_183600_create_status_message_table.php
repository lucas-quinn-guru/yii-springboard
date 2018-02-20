<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status_message`.
 */
class m180220_183600_create_status_message_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('status_message', [
            'id' => $this->primaryKey(),
			'controller' => $this->string( 105 )->notNull()->comment( "Controller Name" ),
			'action' => $this->string( 105 )->notNull()->comment( "Controller Action Name" ),
			'name' => $this->string( 105 )->notNull(),
			'subject' => $this->string( 255 )->notNull(),
			'body' => $this->string( 2025 )->notNull(),
			'description' => $this->string( 255 )->notNull()->comment( "Status Message Description"),
			'create_at' => $this->dateTime(),
			'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('status_message');
    }
}
