<?php

namespace app\controllers\api;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use app\models\User;

use app\models\admin\Product;

class AuthController extends ActiveController
{
    public $modelClass = 'app\models\User';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index'], $actions['create']); 
        return $actions;
    }
    
    public function actionLogin()
    {
        $request = \Yii::$app->request;
        $username = $request->post('username');
        $password = $request->post('password');

        if (!$username || !$password) {
            throw new BadRequestHttpException('Username and password are required');
        }

        $user = User::findByUsername($username);

        if (!$user || !$user->validatePassword($password)) {
            throw new BadRequestHttpException('Invalid username or password');
        }

        $user->generateAccessToken();
        if ($user->save()) {
            return [
                'access_token' => $user->access_token,
            ];
        }

        throw new BadRequestHttpException('Failed to generate access token');
    }
}