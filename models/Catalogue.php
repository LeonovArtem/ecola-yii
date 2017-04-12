<?php
/**
 * Created by PhpStorm.
 * User: aleonov
 * Date: 10.04.2017
 * Time: 16:54
 */

namespace app\models;


use yii\db\ActiveRecord;

class Catalogue extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }
}