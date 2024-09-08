<?php

namespace app\models\admin;

use yii\base\Model;
use app\models\Product;

class ProductForm extends Model
{
    public $name;
    public $description;
    public $price;
    public $category_id;

    public function rules()
    {
        return [
            [['name', 'description', 'price', 'category_id'], 'required', 'message' => 'Заполните поле'],
            [['price'], 'number', 'message'=>'Введите число'],
            [['category_id'], 'integer'],
        ];
    }

    public function loadProduct($id)
    {
        $product = Product::findOne($id);
        if ($product)
        {
            $this->name = $product->name;
            $this->description=$product->description;
            $this->price = $product->price;
            $this->category_id = $product->category_id;
        }
    }

    public function editProduct($id)
    {
        $product = Product::findOne($id);
        if ($product) {
            $product->name = $this->name;
            $product->description = $this->description;
            $product->description = $this->description;
            $product->price = $this->price;
            $product->category_id = $this->category_id;

            return $product->save();
        }
        return false;
    }
}
