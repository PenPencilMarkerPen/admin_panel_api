<?php

namespace app\models\admin;

use yii\base\Model;
use app\models\Category;

class CategoryForm extends Model
{
    public $name;

    public function rules()
    {
        return [
            [['name'], 'required', 'message' => 'Заполните поле'],
            ['name', 'unique', 'targetClass' => Category::class, 'message' => 'Имя категории должно быть уникально'],
        ];
    }

    public function loadCategory($id)
    {
        $category = Category::findOne($id);
        if ($category) {
            $this->name = $category->name;
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOne($id);
        if ($category) {
            $category->name = $this->name;
            return $category->save();
        }
        return false;
    }

}