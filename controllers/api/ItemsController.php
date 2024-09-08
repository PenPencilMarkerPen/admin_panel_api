<?php

namespace app\controllers\api;

use yii\data\ActiveDataProvider;
use yii\data\ActiveDataFilter;
use yii\base\DynamicModel;
use app\controllers\api\RestController;
use app\models\Product;
use app\models\User;

class ItemsController extends RestController
{
    public $modelClass = 'app\models\Product';

    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
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

        $category = $user->getCategory();
        $categoryIds = $category->select('id')->column();

        $products = Product::find()->where(['category_id'=> $categoryIds])->with('category');

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
            $products->andWhere($filterCondition);
        }

        return new ActiveDataProvider([
            'query' => $products,
            'pagination' => [
                'pageSize' => 10, 
            ],
        ]);
    }
    
}