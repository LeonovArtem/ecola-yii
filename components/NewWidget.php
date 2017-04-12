<?php

namespace app\components;


use yii\bootstrap\Widget;

class NewWidget extends Widget
{
    public function init()
    {
        parent::init();

        ob_start();
    }

    public function run()
    {
        $content = ob_get_clean();
        $content = mb_strtoupper($content, 'utf-8');
        return $this->render('new', ['content' => $content]);
    }
}