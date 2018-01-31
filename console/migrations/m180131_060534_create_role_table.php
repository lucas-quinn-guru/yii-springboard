<?php

use yii\db\Migration;

/**
 * Handles the creation of table `role`.
 *
 * ./yii gii/model --tableName=role --className=Role --ns=backend\models --generateRelationsFromCurrentSchema=1
 *
 */
class m180131_060534_create_role_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('role', [
            'id' => $this->primaryKey(),
			'role_name' => $this->string( 45 )->notNull(),
			'role_value' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('role');
    }
}