<?php

use yii\db\Migration;

/**
 * Class m200827_100507_create_module
 */
class m200827_100507_create_module extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin_carousel', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'link' => $this->string(),
            'title' => $this->string(),
            'text' => $this->string(),
            'position' => $this->integer(),
            'active' => $this->boolean()->defaultValue(1),
        ], $this->engine);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200827_100507_create_module cannot be reverted.\n";
        $this->dropTable('admin_carousel');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200827_100507_create_module cannot be reverted.\n";

        return false;
    }
    */
}
