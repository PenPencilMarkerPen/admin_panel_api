<?php

namespace app\models\admin;

use yii\base\Model;
use app\models\User;

class UserEditForm extends Model
{
    public $username;
    public $login;
    public $password;
    public $categories; 

    public function rules()
    {
        return [
            [['username', 'login'], 'required', 'message' => 'Заполните поле'],
            [['password'], 'string'],
            [['categories'], 'safe'], 
        ];
    }

    public function loadUser($id)
    {
        $user = User::findOne($id);
        $this->username=$user->username;
        $this->login=$user->login;
        $category= $user->getCategory()->select('id')->column();
        if ($category)
        {
            $this->categories= $category;
        }
    }

    public function editUser($id){
        $user = User::findOne($id);

        if($user)
        {
            $user->username = $this->username;
            $user->login = $this->login;
            if ($this->password)
            {
                $user->password = \Yii::$app->security->generatePasswordHash($this->password);
                $user->generateAccessToken();
            }   
            if ($user->save()) {
                $user->linkCategories($this->categories);
                return true;
            }
        }   
        return false;
    }
}
