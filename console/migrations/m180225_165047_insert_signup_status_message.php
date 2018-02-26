<?php

use yii\db\Migration;

/**
 * Class m180225_165047_insert_signup_status_message
 */
class m180225_165047_insert_signup_status_message extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->insert( "status_message", [
			"controller" => "site",
			"action" => "signup",
			"name" => "registration autoresponse",
			"subject" => "Thank you for registering!",
			"body" => "Thank you for registering,
			
			We are here to help you pass your real estate exams.  Feel free to give us any feedback to help us improve.
			
			Sincerely,
			The Team",
			"description" => "Confirmation Message on Signup",
			"created_at" => date( "Y-m-d H:i:s" ),
			"updated_at" => date( "Y-m-d H:i:s" )
		] );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		$this->delete( "status_message", "registration autoresponse" );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180225_165047_insert_signup_status_message cannot be reverted.\n";

        return false;
    }
    */
}
