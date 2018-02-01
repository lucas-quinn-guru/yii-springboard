<?php

use yii\db\Migration;

/**
 * Class m180131_222555_add_records_to_status_table
 */
class m180131_222555_add_records_to_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->insert( "status", [ "status_name"=>"Active", "status_value"=>10 ] );
		$this->insert( "status", [ "status_name"=>"Pending", "status_value"=>5 ] );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		$this->delete( "status", "status_name='Active'" );
		$this->delete( "status", "status_name='Pending'" );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180131_222555_add_records_to_status_table cannot be reverted.\n";

        return false;
    }
    */
}
