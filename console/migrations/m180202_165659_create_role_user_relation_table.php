<?php

use yii\db\Migration;

/**
 * Handles the creation of table `role_user_relation`.
 */
class m180202_165659_create_role_user_relation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('role_user', [
            'id' => $this->primaryKey()->unsigned(),
			'user_id' => $this->integer()->unsigned()->notNull(),
			'role_id' => $this->integer()->unsigned()->notNull()
        ]);
        
        $this->alterColumn( "user", "id", "INT(11) UNSIGNED NOT NULL AUTO_INCREMENT" );
        
        $this->addForeignKey( "fk_role_user_user_id", "role_user", "user_id", "user", "id" );
        $this->addForeignKey( "fk_role_user_role_id", "role_user", "role_id", "role", "id" );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
		$this->dropForeignKey( "fk_role_user_user_id", "role_user" );
		$this->dropForeignKey( "fk_role_user_role_id", "role_user" );
	
		$this->alterColumn( "user", "id", "INT(11) SIGNED NOT NULL AUTO_INCREMENT" );
		
		$this->dropTable('role_user');
    }
}
