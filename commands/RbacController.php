<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\User;


class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $author = $auth->createRole('partner');
        $auth->add($author);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        $user = new User();
        $user->username = 'Admin';
        $user->login = 'admin@gmail.com';
        $user->password = \Yii::$app->security->generatePasswordHash('admin');
        $user->generateAccessToken();
        $user->save(false);
        $auth->assign($admin, $user->getId());
    }    
}