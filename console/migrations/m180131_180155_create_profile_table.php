<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 */
class m180131_180155_create_profile_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('profile', [
            'id' => $this->primaryKey()->unsigned(),
			'user_id' => $this->integer()->notNull()->unsigned(),
			'first_name' => $this->string( 60)->null(),
			'last_name' => $this->string( 60)->null(),
			'birthdate' => $this->date()->null(),
			'gender_id' => $this->integer()->notNull()->unsigned(),
			'created_at' => $this->dateTime(),
			'updated_at' => $this->dateTime()
        ]);
	
		$this->addForeignKey('FK_profile_to_gender', 'profile', 'gender_id', 'gender', 'id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
		//$this->dropForeignKey( "FK_profile_to_gender", "profile");
        $this->dropTable('profile');
        
    }
}
