<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\DbHelper;
use yii\data\ArrayDataProvider;

class SiteController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
                    'logout' => ['post', 'get'],
                    'patient-search' => ['post']
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions() {
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
    public function actionIndex($hos = NULL, $cid = NULL, $hn = NULL, $vn = NULL) {
        \Yii::$app->session->set('hos', $hos);
        \Yii::$app->session->set('cid', $cid);
        \Yii::$app->session->set('hn', $hn);
        \Yii::$app->session->set('vn', $vn);
        \Yii::$app->session->set('hn', $hn);

        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin() {
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
    public function actionLogout() {
        Yii::$app->user->logout();

        //return $this->redirect(['/site/login']);
         return $this->redirect(['/user/security/login']); //inam	
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact() {
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
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionPatientSearch() { //  tehnn
        $cid = \Yii::$app->request->post('cid');
        $cid = trim($cid);
        if(empty($cid)){
            return $this->redirect(['index']);
        }
        $sql =  " SELECT t.hn,t.cid,concat(t.prename,t.fname,' ',t.lname) fullname,t.birthday,t.agey 
from gateway_emr_patient t   
WHERE t.hn like '%$cid%'  or t.cid like  '%$cid%' or t.fname like  '%$cid%'  or  t.lname like  '%$cid%' order by t.hn";
        
        $raw = DbHelper::queryAll('db', $sql);
        $dataProvider = new ArrayDataProvider([
            'allModels'=>$raw
        ]);
        
        return $this->render('patient_search',[
            'dataProvider'=>$dataProvider
        ]);
        
        
    }

}
