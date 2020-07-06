<?php

use yii\db\Migration;

/**
 * Class m200706_134232_article
 */
class m200706_134232_article extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    public function safeUp()
    {
        $this->createTable('admin_articles', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'image' => $this->string(),
            'name' => $this->string(),
            'text' => $this->text(),
            'active' => $this->boolean()->defaultValue(true),
        ], $this->engine);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200706_134232_article cannot be reverted.\n";
        $this->dropTable('admin_articles');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200706_134232_article cannot be reverted.\n";

        return false;
    }
    */
}
