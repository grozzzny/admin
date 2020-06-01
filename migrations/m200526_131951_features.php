<?php

use yii\db\Migration;

/**
 * Class m200526_131951_features
 */
class m200526_131951_features extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    public function up()
    {
        $this->createTable('admin_features', [
            'id' => $this->primaryKey(),
            'icon' => $this->string(),
            'image' => $this->string(),
            'title' => $this->string(),
            'description' => $this->string(),
            'link' => $this->string(),
            'position' => $this->integer(),
            'active' => $this->boolean()->defaultValue(true),
        ], $this->engine);

        $this->createTable('admin_testimonials', [
            'id' => $this->primaryKey(),
            'image' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(),
            'position' => $this->integer(),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createTable('admin_feedback', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'phone' => $this->string(),
            'message' => $this->string(),
            'active' => $this->boolean()->defaultValue(true),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);

        $this->createTable('admin_social_links', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'link' => $this->string(),
            'icon' => $this->string(),
            'position' => $this->integer(),
            'active' => $this->boolean()->defaultValue(true),
        ], $this->engine);
    }

    public function down()
    {
        $this->dropTable('admin_features');
        $this->dropTable('admin_testimonials');
        $this->dropTable('admin_feedback');
        $this->dropTable('admin_social_links');

        echo "m200526_131951_features cannot be reverted.\n";

        return false;
    }
}
