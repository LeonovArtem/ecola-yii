<?php
/**
 * Created by PhpStorm.
 * User: aleonov
 * Date: 21.03.2017
 * Time: 10:19
 */

namespace app\controllers;


use yii\web\Controller;
use app\models\Partners;
use yii\data\Pagination;

class PartnersController extends Controller
{
    public function actionIndex()
    {

        $query = Partners::find()->select('ID, NAME , int(PRICE) as PRICE');
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 20,
            'pageSizeParam' => false, 'forcePageParam' => false]);
        $goods = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('index', compact('pages', 'goods'));

    }

    public function actionLoginTest()
    {
        echo __METHOD__;
    }

} 



