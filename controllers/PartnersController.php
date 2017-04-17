<?php
/**
 * Created by PhpStorm.
 * User: aleonov
 * Date: 21.03.2017
 * Time: 10:19
 */

namespace app\controllers;


use app\models\Partners;
use yii\data\Pagination;

class PartnersController extends MainController
{
    /**
     * Выполняется до Вызова Основного action;
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if ($action->id == 'search') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

//    public function actionIndex()
//    {
//        return $this->render('shop', compact('pages', 'goods'));
//    }
    public function actionIndex()
    {
//        $this->view->title='Партнерам';
//        $this->view->registerMetaTag(['name'=>'keywords','content'=>'Ecola,магазин Ecola, экола']);
//        $this->view->registerMetaTag(['name'=>'description','content'=>'Интернет магазин для партнеров комапании Ecola']);
        $query = Partners::find()->select('ID, PARTNUM, NAME , int(PRICE) as PRICE');
        $pages = new Pagination(['totalCount' => $query->count(),
            'pageSize' => 20,
            'pageSizeParam' => false, 'forcePageParam' => false]);
        $goods = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('shop', compact('pages', 'goods'));
    }

    public function actionNick()
    {
        echo __METHOD__;
    }

    public function actionOrder()
    {
        echo __METHOD__;
    }

    public function actionCart()
    {
        echo __METHOD__;
    }

    public function actionSearch()
    {
        if (\Yii::$app->request->isAjax) {
            echo '<pre>';
            print_r($_REQUEST);
            echo '</pre>';
            
        }
//        return $this->render('search', compact('name, age'));
    }

} 



