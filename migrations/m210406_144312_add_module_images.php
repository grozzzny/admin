<?php

use yii\db\Migration;

/**
 * Class m210406_144312_add_module_images
 */
class m210406_144312_add_module_images extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin_image_files', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'name' => $this->string(),
            'file' => $this->string(),
            'active' => $this->boolean()->defaultValue(true),
        ], $this->engine);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210406_144312_add_module_images cannot be reverted.\n";
        $this->dropTable('admin_image_files');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210406_144312_add_module_images cannot be reverted.\n";

        return false;
    }
    */
}
