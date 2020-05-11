<?php

use yii\db\Migration;

/**
 * Class m200511_151453_text_module
 */
class m200511_151453_text_module extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    public function up()
    {
        $this->createTable('admin_text', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(),
            'text' => $this->string(),
        ], $this->engine);
    }

    public function down()
    {
        $this->dropTable('text');

        echo "m200511_151453_text_module cannot be reverted.\n";

        return false;
    }
}
