<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gender`.
 */
class m180131_180000_create_gender_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('gender', [
            'id' => $this->primaryKey()->unsigned(),
			'gender_name' => $this->string( 45 )->notNull(),
        ]);
        
        $this->insert( "gender", ["gender_name"=>"male" ] );
		$this->insert( "gender", ["gender_name"=>"female" ] );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('gender');
    }
}
