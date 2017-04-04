<?php
/**
 * Created by PhpStorm.
 * User: aleonov
 * Date: 21.03.2017
 * Time: 12:02
 */

namespace app\models;


use yii\db\ActiveRecord;

class Partners extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db2;
    }

    public static function tableName()
    {
        return 'VW_INTERNETGOODS'; // Вьюшка
    }
}

