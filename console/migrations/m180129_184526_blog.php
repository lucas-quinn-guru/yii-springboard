<?php

use yii\db\Migration;

/**
 * Class m180129_184526_blog
 */
class m180129_184526_blog extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			// http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
	
		$this->createTable('{{%blog}}', [
			'id' => $this->primaryKey(),
			'user_id' => $this->string()->notNull()->unique(),
			'title' => $this->string(32)->notNull(),
			'summary'=>$this->string( 2044 )->notNull(),
			'body' => $this->text()->notNull(),
			'status' => $this->smallInteger()->notNull()->defaultValue(10),
			'published_at'=> $this->dateTime()->notNull(),
			'created_at' => $this->dateTime()->notNull(),
			'updated_at' => $this->dateTime()->notNull(),
		], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		$this->dropTable('{{%blog}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180129_184526_blog cannot be reverted.\n";

        return false;
    }
    */
}
