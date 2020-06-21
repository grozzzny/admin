<?php

use yii\db\Migration;

/**
 * Class m200621_160445_images
 */
class m200621_160445_images extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin_images', [
            'id' => $this->primaryKey(),
            'key' => $this->string(),
            'item_id' => $this->integer(),
            'author' => $this->string(),
            'description' => $this->string(),
            'file' => $this->string(),
        ], $this->engine);
        $this->createIndex('index_key_item_id', 'admin_images', ['key', 'item_id'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('admin_images');

        echo "m200621_160445_images cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200621_160445_images cannot be reverted.\n";

        return false;
    }
    */
}
