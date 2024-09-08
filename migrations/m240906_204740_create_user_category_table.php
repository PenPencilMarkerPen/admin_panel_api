<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_category}}`.
 */
class m240906_204740_create_user_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_category}}', [
            'user_id'=>$this->bigInteger()->notNull(),
            'category_id'=>$this->bigInteger()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-user_category-user_id',
            'user_category',
            'user_id',
            'users',
            'id',
            'cascade',
        );

        $this->addForeignKey(
            'fk-user_category-category_id',
            'user_category',
            'category_id',
            'categories',
            'id',
            'cascade',
        );
        $this->addPrimaryKey(
            'pk-user_category',             
            'user_category',          
            ['user_id', 'category_id']      
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_category}}');
    }
}
