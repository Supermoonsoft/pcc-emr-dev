<?php

namespace app\modules\lab\controllers;

use Yii;
use app\modules\lab\models\Hoslab;
use app\modules\lab\models\HoslabSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class HoslabController extends Controller
{

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


    public function actionIndex($cid=NULL)
    {

        $searchModel = new HoslabSearch($cid);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'cid'=>$cid
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Hoslab();

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


    protected function findModel($id)
    {
        if (($model = Hoslab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAddgroup()
    {

        $id = explode(',', Yii::$app->request->post('id'));//typecasting


        $lab_name_hos = Yii::$app->request->post('lab_name_hos');
        $result_at = Yii::$app->request->post('result_at');
        $hos_result = Yii::$app->request->post('hos_result');

        //print_r($selection);
        /*
        foreach($id as $id){
            //echo $id;
            $immuno_staining = ImmunoStaining::find()->where(['id' => $id])->all();//->andWhere('group_name '. new Expression('IS NULL'))
            foreach($immuno_staining as $im){
                //echo $im->finance->charge->name.'<br />';
                $ims = ImmunoStaining::findOne(['id' => $im->id]);
                $ims->group_name = $group_name.$group_number;
                if($ims->save()){
                    //echo 'y';
                }else{
                    //echo 'n';
                }
            }
        }*/
        print_r($selection);
        echo $lab_name_hos;
        echo $result_at;
        echo $hos_result;
        die();
        Yii::$app->session->setFlash('success', 'บันทึกรอบการย้อมเรียบร้อยแล้ว');
        return $this->redirect(['index']);
    }

}
