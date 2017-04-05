<?php
/**
 * Подписка на рассылку
 */


namespace app\models;


use yii\base\Model;

class MailForm extends Model
{
    public $name;
    public $email;
    public $text;
}