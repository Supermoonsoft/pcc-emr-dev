<?php

namespace app\modules\doctorworkbench\controllers;

use Yii;
use app\modules\doctorworkbench\models\PccDiagnosis;
use app\modules\doctorworkbench\models\PccDiagnosisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\doctorworkbench\models\CIcd10tm;

class PccDiagnosisController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new PccDiagnosisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new PccDiagnosis();

        return $this->renderAjax('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate(){
      
        $model = new PccDiagnosis();
        return $this->renderAjax('create', [
            'model' => $model,
        ]);

    }

    public function actionSave(){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $icd_code = Yii::$app->request->post('icd_code');
        $icd_name = CIcd10tm::find()->where(['diagcode' => $icd_code])->one()->diagename;
        $model = new PccDiagnosis();
        $model->hn = 000001;
        $model->vn = 88888888;
        $model->icd_code = $icd_code;
        $model->icd_name = $icd_name;
        $model->diag_type = 1;
        $model->save(false);
        return [
            'data' =>Yii::$app->request->post('icd_code')
        ];
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
        if (($model = PccDiagnosis::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIcd10List($q = null, $id = null){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; //กำหนดการแสดงผลข้อมูลแบบ json
        $out = ['results'=>['diagcode'=>'','text'=>'']];
        if(!is_null($q)){
            $query = new \yii\db\Query();
            $query->select('diagcode as id, diagcode as text')
                    ->from('c_icd10tm')
                    ->where("diagcode LIKE '%".$q."%'")
                    ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }else if($id>0){
            $out['results'] = ['diagcode'=>$id, 'text'=>  CIcd10tm::find($id)->diagcode];
        }
        return $out;
    }
}
