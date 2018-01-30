<?php

use yii\db\Migration;

/**
 * Class m180130_154412_update_user_table
 */
class m180130_154412_update_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->addColumn('user', 'role_id', $this->smallInteger()->after( 'email' )->defaultValue( 1 )->notNull() );
		$this->renameColumn( 'user', 'status', 'status_id' );
		$this->alterColumn( 'user', 'status_id', $this->smallInteger()->defaultValue( 1 )->notNull() );
		$this->addColumn( 'user', 'user_type_id', $this->smallInteger()->after( 'status_id' )->defaultValue( 1 )->notNull() );
		$this->alterColumn( 'user', 'created_at', $this->dateTime()->notNull() );
		$this->alterColumn( 'user', 'updated_at', $this->dateTime()->notNull() );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
	{
		$this->dropColumn( 'user', 'role_id' );
		$this->renameColumn( 'user', 'status_id', 'status' );
		$this->alterColumn( 'user', 'status', $this->smallInteger()->defaultValue( 10 )->null() );
		$this->dropColumn( 'user', 'user_type_id' );
		$this->alterColumn( 'user', 'created_at', $this->integer(11 ) );
		$this->alterColumn( 'user', 'updated_at', $this->integer(11 ) );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180130_154412_update_user_table cannot be reverted.\n";

        return false;
    }
    */
}
