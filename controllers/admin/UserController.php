<?php

namespace app\controllers\admin;

use Yii;
use app\models\admin\UserForm;
use app\models\admin\UserEditForm;
use app\models\User;
use yii\data\Pagination;
use app\controllers\admin\AdminController;


class UserController extends AdminController
{

    public function actionAddUser()
    {
        $model = new UserForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['users']);
        }

        return $this->render('user', [
            'model' => $model,
        ]);
    }

    public function actionUsers()
    {
        $query = User::find();

        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount'=>$query->count(),
        ]);

        $users = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('users', [
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);
        if ($user) {
            $user->delete();
        }
        return $this->redirect(['users']);
    }

    public function actionEdit($id)
    {
        $model = new UserEditForm();
        $model->loadUser($id);


        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->editUser($id))
                return $this->redirect(['users']);            
        }

        return $this->render('edit', ['model' => $model]);  

    }
}
