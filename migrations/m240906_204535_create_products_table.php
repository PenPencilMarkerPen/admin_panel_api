<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m240906_204535_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'name' =>$this->string(100)->notNull(),
            'description'=>$this->string(255)->notNull(),
            'price'=>$this->money()->notNull(),
            'category_id'=>$this->bigInteger()->notNull(),
        ]);
        $this->addForeignKey('fk_category_users', 'products', 'category_id', 'categories', 'id', 'cascade' );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
