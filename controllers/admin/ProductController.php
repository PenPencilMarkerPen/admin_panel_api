<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\ProductForm;
use app\models\Product;

use yii\data\Pagination;
use app\controllers\admin\AdminController;


class ProductController extends AdminController
{
    public function actionAddProduct()
    {
        $model = new ProductForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $product = new Product();
            $product->name= $model->name;
            $product->description= $model->description;
            $product->price= $model->price;
            $product->category_id= $model->category_id;
            if($product->save())
                return $this->redirect(['products']);
        }
        return $this->render('product', ['model' => $model]);  
    }   

    public function actionProducts()
    {
        $query = Product::find()->with('category');

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount'=>$query->count(),
        ]);

        $products = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('products', [
            'products' => $products,
            'pagination' => $pagination,
        ]);
    }

    public function actionDelete($id)
    {
        $product = Product::findOne($id);

        if ($product) {
            $product->delete();
        }
        return $this->redirect(['products']);
    }

    public function actionEdit($id)
    {
        $model= new ProductForm();
        $model->loadProduct($id);


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->editProduct($id)) {
                return $this->redirect(['products']);            
            }
        }
        
        return $this->render('edit', ['model' => $model]);  

    }
}
