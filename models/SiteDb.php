<?php
/**
 * Created by PhpStorm.
 * User: aleonov
 * Date: 10.04.2017
 * Time: 16:56
 */

namespace app\models;


use yii\db\ActiveRecord;

class SiteDb extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }
}