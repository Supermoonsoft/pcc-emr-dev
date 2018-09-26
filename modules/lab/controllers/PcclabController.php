<?php

namespace app\modules\lab\controllers;

use Yii;
use app\modules\lab\models\Pcclab;
use app\modules\lab\models\PcclabSeach;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 * PcclabController implements the CRUD actions for Pcclab model.
 */
class PcclabController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pcclab models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PcclabSeach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Pcclab(); 

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
               return   $this->renderAjax('index',[
                     'searchModel' => $searchModel,
                     'dataProvider' => $dataProvider,
                     'model' => $model
                     ]);
             } else {
                return $this->renderAjax('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model
                ]);
            }
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Pcclab();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionAddgroup()
    {

            Yii::$app->response->format = Response::FORMAT_JSON;
            $post = Yii:: $app->request->post();
            $data = [];
            if (Yii::$app->request->isAjax) {
                // do your data processing here
         
                // set response data
                if (success) {
                    $data = ['sucess' => true, /* rest of the data */];
                }
                else {
                    $data = ['success' => false, 'error' => 'Some error message'];
                }
                return $this->renderAjax('index',['data'=> $data]);
            }
        
    }

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }


public function parseRequest($manager, $request, $add_post = true, $add_files = true) {
    $result = parent::parseRequest($manager, $request);
    if($result !== false) {
        list($route, $params) = $result;
        if($add_post    === true) {
            $params = array_merge($params,$_POST);
        }
        if($add_files   === true) {
            $params = array_merge($params,$_FILES);
        }
        return [$route, $params];
    }
    return false;
}

    protected function findModel($id)
    {
        if (($model = Pcclab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPreorderlab()
    {
        $searchModel = new PcclabSeach();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Pcclab(); 

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
               return   $this->renderAjax('/lab/preorderlab/index',[
                     'searchModel' => $searchModel,
                     'dataProvider' => $dataProvider,
                     'model' => $model
                     ]);
             } else {
                return $this->renderAjax('/lab/preorderlab/index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'model' => $model
                ]);
            }
    }

    public function actionAddgroup_()
    {

        //$id_cases = explode(',', Yii::$app->request->post('id_case'));//typecasting
        
        //$id_cases = explode(',',["7175c4d3-a64a-44d2-9ed7-58aadbd92a33", "0b42a15a-3a17-4413-b939-018a765f306b", "ce267365-ba40-47ba-b6cc-64a40b6c2714"]);

        //$lab_name = Yii::$app->request->post('lab_name');
        //$message ='';
        //$group_number = Yii::$app->request->post('group_number');
        //print_r($selection);
        //foreach($id_cases as $id){
            //echo $id;
        //    $message .= '[Id :'.$id.',';
        //    $pcclab = Pcclab::find()->where(['id' => $id])->all();//->andWhere('group_name '. new Expression('IS NULL'))
        //    foreach($pcclab as $im){
                
                //echo $im->finance->charge->name.'<br />';
        //        $ims = Pcclab::findOne(['id' => $im->id]);
        //        $ims->labname = $labname;
        //        $message .= 'Labname :'.$ims->labname.',';//test
                /*if($ims->save()){
                    //echo 'y';
                }else{
                    //echo 'n';
                }
                */
        //    }
        //    $message .= '],';
        //}

        //Yii::$app->session->setFlash('success', 'บันทึกรอบการย้อมเรียบร้อยแล้ว');
        return $this->redirect(['addgroup']);
    }
}
