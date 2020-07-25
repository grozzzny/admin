<?php

use yii\db\Migration;

/**
 * Class m200725_140221_add_modules
 */
class m200725_140221_add_modules extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin_files', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'name' => $this->string(),
            'file' => $this->string(),
            'active' => $this->boolean()->defaultValue(true),
        ], $this->engine);

        $this->createTable('admin_gallery', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'name' => $this->string(),
            'active' => $this->boolean()->defaultValue(true),
        ], $this->engine);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200725_140221_add_modules cannot be reverted.\n";
        $this->dropTable('admin_files');
        $this->dropTable('admin_gallery');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200725_140221_add_modules cannot be reverted.\n";

        return false;
    }
    */
}
