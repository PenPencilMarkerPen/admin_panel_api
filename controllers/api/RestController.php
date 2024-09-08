<?php

namespace app\controllers\api;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\web\Response;


use app\models\admin\Product;

class RestController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::class,
        ];

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'only' => ['index', 'view'],
            'rules' => [
                [
                    'allow' => true,
                    'roles' => ['partner'], 
                ],
            ],
        ];

        return $behaviors;
    }

}