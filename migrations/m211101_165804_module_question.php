<?php

use yii\db\Migration;

/**
 * Class m211101_165804_module_question
 */
class m211101_165804_module_question extends Migration
{
    public $engine = 'ENGINE=InnoDB DEFAULT CHARSET=utf8';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('admin_question', [
            'id' => $this->primaryKey(),
            'question' => $this->string(),
            'answer' => $this->string(),
            'active' => $this->boolean()->defaultValue(false),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->engine);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m211101_165804_module_question cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211101_165804_module_question cannot be reverted.\n";

        return false;
    }
    */
}
