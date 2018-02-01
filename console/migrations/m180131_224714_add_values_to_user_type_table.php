<?php

use yii\db\Migration;

/**
 * Class m180131_224714_add_values_to_user_type_table
 */
class m180131_224714_add_values_to_user_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->insert( "user_type", [ "user_type_name"=>"Free", "user_type_value"=>10 ] );
		$this->insert( "user_type", [ "user_type_name"=>"Paid", "user_type_value"=>30 ] );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		$this->delete( "user_type","user_type_name='Free'" );
		$this->delete( "user_type","user_type_name='Paid'" );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180131_224714_add_values_to_user_type_table cannot be reverted.\n";

        return false;
    }
    */
}
