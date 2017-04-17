<?php
/**
 * Page Where By?
 */

namespace app\models;


use yii\db\ActiveRecord;

class Where extends ActiveRecord
{
    public static function getDb()
    {
        return \Yii::$app->db;
    }

    public static function tableName()
    {
        return 'where_buy';
    }
}