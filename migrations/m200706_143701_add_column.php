<?php

use yii\db\Migration;

/**
 * Class m200706_143701_add_column
 */
class m200706_143701_add_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('admin_articles', 'short', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200706_143701_add_column cannot be reverted.\n";
        $this->dropColumn('admin_articles', 'short');
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200706_143701_add_column cannot be reverted.\n";

        return false;
    }
    */
}
