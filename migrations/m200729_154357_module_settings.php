<?php

use yii\db\Migration;

/**
 * Class m200729_154357_module_settings
 */
class m200729_154357_module_settings extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin_settings', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'name' => $this->string(),
            'value' => $this->text()
        ], $this->engine);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200729_154357_module_settings cannot be reverted.\n";
        $this->dropTable('admin_settings');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200729_154357_module_settings cannot be reverted.\n";

        return false;
    }
    */
}
