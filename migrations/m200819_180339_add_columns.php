<?php

use yii\db\Migration;

/**
 * Class m200819_180339_add_columns
 */
class m200819_180339_add_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('admin_articles', 'created_at', $this->integer());
        $this->addColumn('admin_articles', 'updated_at', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200819_180339_add_columns cannot be reverted.\n";
        $this->dropColumn('admin_articles', 'created_at');
        $this->dropColumn('admin_articles', 'updated_at');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200819_180339_add_columns cannot be reverted.\n";

        return false;
    }
    */
}
