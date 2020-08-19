<?php

use yii\db\Migration;

/**
 * Class m200819_084730_add_module
 */
class m200819_084730_add_module extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin_editable', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'code' => $this->text(),
            'active' => $this->boolean()->defaultValue(1),
        ], $this->engine);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200819_084730_add_module cannot be reverted.\n";
        $this->dropTable('admin_editable');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200819_084730_add_module cannot be reverted.\n";

        return false;
    }
    */
}
