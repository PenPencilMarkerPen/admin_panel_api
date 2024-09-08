<?php

namespace app\models;

use app\models\User;
use yii\db\ActiveRecord;
use app\models\Product;


class Category  extends ActiveRecord {

    public static function tableName()
    {
        return 'categories';
    }

    public function getProducts()
    {
        return $this->hasMany(Product::class, ['category_id' => 'id']);
    }

    public function getUser()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])
            ->viaTable('user_category', ['category_id' => 'id']);
    }
}