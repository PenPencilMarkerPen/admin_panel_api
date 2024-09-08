<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\CategoryForm;
use app\models\Category;
use yii\data\Pagination;
use app\controllers\admin\AdminController;


class CategoryController extends AdminController
{

    public function actionAddCategory()
    {
        $model = new CategoryForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $category = new Category();
            $category->name = $model->name;
            if($category->save())
                return $this->redirect(['categories']);
        }
        else {
            return $this->render('category', ['model' => $model]);  
        }

    }

    public function actionCategories()
    {
        $query = Category::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount'=>$query->count(),
        ]);

        $categories = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

        return $this->render('categories', [
            'categories' => $categories,
            'pagination' => $pagination,
        ]);
    }

    public function actionDelete($id)
    {
        $category = Category::findOne($id);
        if ($category) {
            $category->delete();
        }
        return $this->redirect(['categories']);
    }

    public function actionEdit($id)
    {
        $model = new CategoryForm();
        $model->loadCategory($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->editCategory($id)) {
                return $this->redirect(['categories']);            
            }
        }

        return $this->render('edit', ['model' => $model]);  
    }
}
