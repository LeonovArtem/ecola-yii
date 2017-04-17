<?php

namespace app\controllers;

use Yii;
use yii\debug\models\search\Debug;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\MailForm;
use app\models\Catalogue;
use app\models\Where;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
            $name = 'Artem';
//            return $this->render('catalogue',compact('name'));
            return $this->redirect('partners/index');
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays test page.
     *
     * @return string
     */
    public function actionMail()
    {
        $model = new MailForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                debug($model);
                Yii::$app->session->setFlash('success', 'Ваше сообщение успешно оправлено');
                return $this->refresh();
//                die;
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка');
            }
        }
        return $this->render('mail', compact('model'));
    }

    public function actionCatalogue($id = '')
    {
        $query = Catalogue::find()->select('IDPAGE ,title');
        $cataloge = $query->all();
        return $this->render('catalogue', compact('cataloge'));
    }

    public function actionWhere()
    {
//        $arr = [23, 41, 789];
//        for ($i = 0, $n = count($arr); $i < $n; $i++) {
//            setcookie("goods[$i]", $arr[$i], time() + 36000);
//        }

        return $this->render('where');
    }

    public function actionParse()
    {
        if (Yii::$app->request->isAjax) {
            $where = new Where();
            $row = Yii::$app->request->post('fields');
                $where->title = $this->parse($row[0]);
                $where->city = $this->parse($row[1]);
                $where->address = $this->parse($row[2]);
                $where->contact = $this->parse($row[3]);
                $where->save();
        }

    }

    private function parse($str)
    {
        $pattern = '/<[\/\!]*?[^(\/a)][^<>]+?>/is';
        $field = preg_replace($pattern, ' ', $str);
        $myTrim = preg_replace('/\s{2,}/is', ' ', $field);
        return htmlspecialchars(trim($myTrim));
    }

}
