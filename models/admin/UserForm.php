<?php

namespace app\models\admin;

use yii\base\Model;
use app\models\User;

class UserForm extends Model
{
    public $username;
    public $login;
    public $password;
    public $categories; 

    public function rules()
    {
        return [
            [['username', 'login', 'password'], 'required', 'message' => 'Заполните поле'],
            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Данное имя пользователя уже занято'],
            ['login', 'unique', 'targetClass' => User::class, 'message' => 'Данный логин занят'],
            [['categories'], 'safe'], 
        ];
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $auth = \Yii::$app->authManager;

        $user = new User();
        $user->username = $this->username;
        $user->login = $this->login;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->generateAccessToken();
        $authorRole = $auth->getRole('partner');

        if ($user->save()) {
            $auth->assign($authorRole, $user->getId());
            $user->linkCategories($this->categories);
            return true;
        }

        return false;
    }

}
