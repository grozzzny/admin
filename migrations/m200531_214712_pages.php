<?php

use yii\db\Migration;

/**
 * Class m200531_214712_pages
 */
class m200531_214712_pages extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    public function up()
    {
        $this->createTable('admin_pages', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'image' => $this->string(),
            'name' => $this->string(),
            'text' => $this->text(),
            'active' => $this->boolean()->defaultValue(true),
        ], $this->engine);

        $this->createTable('admin_seo', [
            'id' => $this->primaryKey(),
            'key' => $this->string(),
            'item_id' => $this->integer(),
            'h1' => $this->string(),
            'title' => $this->string(),
            'keywords' => $this->string(),
            'description' => $this->string(),
            'image' => $this->string(),
        ], $this->engine);
        $this->createIndex('index_key_item_id', 'admin_seo', ['key', 'item_id'], true);
    }

    public function down()
    {
        $this->dropTable('admin_pages');
        $this->dropTable('admin_seo');

        echo "m200531_214712_pages cannot be reverted.\n";

        return false;
    }
}
