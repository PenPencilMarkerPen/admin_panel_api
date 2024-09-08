<?php

namespace app\models;

use app\models\Category;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

use app\models\UserCategory;

class User extends ActiveRecord implements IdentityInterface
{
    private $authKey;

    public function init()
    {
        parent::init();
        // \Yii::$app->user->enableSession = true;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                QueryParamAuth::class,
            ],
        ];
        return $behaviors;
    }

    public static function tableName()
    {
        return '{{users}}';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username'=>$username]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function generateAccessToken() {
        $this->access_token = \Yii::$app->security->generateRandomString($length = 55);
    }

    public function generateAuthKey()
    {
        $this->authKey = \Yii::$app->security->generateRandomString();
    }

    public function getRole()
    {
        $auth = \Yii::$app->authManager;
        $roles = $auth->getRolesByUser($this->id);
        
        if ($roles) {
            return reset($roles)->name;
        }
        return 'Нет роли';
    }

    public function getCategory()
    {
        return $this->hasMany(Category::class, ['id' => 'category_id'])
            ->viaTable('user_category', ['user_id' => 'id']);
    }

    public function linkCategories($categories)
    {
        UserCategory::deleteAll(['user_id' => $this->id]);

        if (!empty($categories))
        {
            foreach ($categories as $categoryId) {
                $userCategory = new UserCategory();
                $userCategory->user_id = $this->id;
                $userCategory->category_id = $categoryId;
                $userCategory->save();
            }
        }
    }
}