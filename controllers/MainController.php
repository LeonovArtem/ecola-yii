<?php
/**
 * Главный контроллер
 */

namespace app\controllers;


use yii\web\Controller;

class MainController extends Controller
{
    public static function debug($var){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}