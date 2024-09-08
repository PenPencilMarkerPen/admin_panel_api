<?php

namespace app\controllers\api;

use yii\data\ActiveDataProvider;
use yii\data\ActiveDataFilter;
use app\controllers\api\RestController;
use app\models\User;
use app\components\ItemsFilter;
use yii\base\DynamicModel;

class CategoriesController extends RestController
{
    public $modelClass = 'app\models\Category';


    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'category',
    ];

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex()
    {
        $userId = \Yii::$app->user->id;
        $user = User::findOne($userId);
        $categories = $user->getCategory();

        $filter = new ActiveDataFilter([
            'searchModel' => (new DynamicModel(['name']))
                ->addRule(['name'], 'string')
        ]);

        $filterCondition = null;

        $requestParams = \Yii::$app->request->get();
        $filterParams = [];

        if (isset($requestParams['name'])) {
            $filterParams['name'] = $requestParams['name'];
        }

        if ($filter->load(['filter' => $filterParams])) { 
            $filterCondition = $filter->build();
            if ($filterCondition === false) {
                return $filter;
            }
        }

        if ($filterCondition !== null) {
            $categories->andWhere($filterCondition);
        }

        return new ActiveDataProvider([
            'query' => $categories,
            'pagination' => [
                'pageSize' => 10, 
            ],
        ]);
    }

    
}