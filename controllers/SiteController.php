<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Pemasukan;
use app\models\Rekap;
use app\models\RekapSearch;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index','logout'],
                'rules' => [
                    [
                        'actions' => ['index','logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
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
        $searchModel = new RekapSearch();
        $searchModel->TANGGAL = date('Y');
        if(Yii::$app->request->post()):
            $searchModel->TANGGAL = Yii::$app->request->post()['RekapSearch']['TANGGAL'];
        endif;
        // Pemasukan Bulanan
        $bulananPem['January'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-01')])->sum('NOMINAL');
        $bulananPem['February'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-02')])->sum('NOMINAL');
        $bulananPem['March'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-03')])->sum('NOMINAL');
        $bulananPem['April'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-04')])->sum('NOMINAL');
        $bulananPem['May'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-05')])->sum('NOMINAL');
        $bulananPem['June'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-06')])->sum('NOMINAL');
        $bulananPem['July'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-07')])->sum('NOMINAL');
        $bulananPem['August'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-08')])->sum('NOMINAL');
        $bulananPem['September'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-09')])->sum('NOMINAL');
        $bulananPem['October'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-10')])->sum('NOMINAL');
        $bulananPem['November'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-11')])->sum('NOMINAL');
        $bulananPem['December'] = Pemasukan::find()->andWhere(['LIKE','TANGGAL',date($searchModel->TANGGAL.'-12')])->sum('NOMINAL');

        // Pengeluaran Bulanan
        $bulananPeng['January'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-01')])->sum('NOMINAL');
        $bulananPeng['February'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-02')])->sum('NOMINAL');
        $bulananPeng['March'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-03')])->sum('NOMINAL');
        $bulananPeng['April'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-04')])->sum('NOMINAL');
        $bulananPeng['May'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-05')])->sum('NOMINAL');
        $bulananPeng['June'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-06')])->sum('NOMINAL');
        $bulananPeng['July'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-07')])->sum('NOMINAL');
        $bulananPeng['August'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-08')])->sum('NOMINAL');
        $bulananPeng['September'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-09')])->sum('NOMINAL');
        $bulananPeng['October'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-10')])->sum('NOMINAL');
        $bulananPeng['November'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-11')])->sum('NOMINAL');
        $bulananPeng['December'] = Rekap::find()->andWhere(['LIKE', 'TANGGAL', date($searchModel->TANGGAL.'-12')])->sum('NOMINAL');
 
        return $this->render('index',[
            'searchModel' => $searchModel,
            'bulananPem' => $bulananPem,
            'bulananPeng' => $bulananPeng
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
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
}
