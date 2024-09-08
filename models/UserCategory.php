<?php

namespace app\models;

use yii\db\ActiveRecord;

class UserCategory  extends ActiveRecord {

    public static function tableName()
    {
        return 'user_category';
    }
}