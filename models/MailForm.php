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

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Ваш E-mail',
            'text' => 'Текст сообщения',
        ];
    }

    public function rules()
    {
        return [
//            [['name', 'email', 'text'], 'required','message'=>'Поле обязательно'],
            [['name', 'email'], 'required'],
            [['name', 'email','text'], 'trim'],
            ['name', 'string', 'length' => [2, 30]],
            ['email', 'email'],
            ['name','nameRule'],


//            ['text', 'filter', 'filter' =>function ($value) {
////                return preg_replace('/\w+/',' ',$str);
//                  return $value.'one';
//            }],
//            ['name', 'string', 'min' => 2,'tooShort'=>'Wrong!'],
//            ['name', 'string', 'min' => 2],
//            ['name', 'string', 'max' => 4,'tooLong'=>'Много!!'],
        ];
    }
    public function nameRule($attr){
        if(!in_array($this->$attr,['root','admin']))
            $this->addError($attr,'Неверное имя:(');
    }

}