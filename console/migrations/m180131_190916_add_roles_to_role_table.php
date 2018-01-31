<?php

use yii\db\Migration;

/**
 * Class m180131_190916_add_roles_to_role_table
 */
class m180131_190916_add_roles_to_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->insert( "role", [ "role_name"=>"User", "role_value"=>10 ] );
		$this->insert( "role", [ "role_name"=>"Admin", "role_value"=>20 ] );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete( "role", "role_name='User'" );
        $this->delete( "role", "role_name='Admin'" );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180131_190916_add_roles_to_role_table cannot be reverted.\n";

        return false;
    }
    */
}
