<?php

namespace app\components;

use yii\base\Widget;

class MyWidget extends Widget
{
    public $pn;
    public $title;
    public $price;
    public $quantity;
    public $stock;

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if (!isset($this->title)) {
            $this->title = 'Нет товара';
        }

    }

    public function run()
    {
        return $this->render('my', [
            'pn' => $this->pn,
            'title' => $this->title,
            'price' => $this->price,
        ]);

    }

}