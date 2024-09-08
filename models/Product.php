<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Product  extends ActiveRecord {

    public static function tableName()
    {
        return 'products';
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['category_id']);

        $fields['category'] = function () {
            return $this->category ? $this->category->name : null; 
        };

        return $fields;
    }
}