<?php

namespace app\modules\lab\controllers;

use Yii;
use app\modules\lab\models\Pcclab;
use app\modules\lab\models\PcclabSearch;
use app\modules\lab\models\Preorderlab;
use app\modules\lab\models\PreorderlabSearch;

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
        $searchModel = new PcclabSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new Pcclab(); 

       
            
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
           //  Yii::$app->response->format = Response::FORMAT_JSON;
            // $post = Yii:: $app->request->post();
            // if (Yii::$app->request->isAjax) {
            //    // return $this->renderAjax('addgroup');
            //    return 'success';
            // }
           // return 'hello';
        
    }


    protected function findModel($id)
    {
        if (($model = Pcclab::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionPreorder(){
        $action=Yii::$app->request->post('action');
        $selection=(array)Yii::$app->request->post('selection');//typecasting

            foreach($selection as $id){
                $model = Pcclab::findOne((String)$id);//make a typecasting
                $preorder = new Preorderlab(); 

                    $preorder->hospcode = $model->hospcode;
                    $preorder->lab_code = $model->lab_code;
                    $preorder->lab_name = $model->lab_name;
                    $preorder->lab_request_date = date('Y-m-d');
                    $preorder->standard_result = $model->standard_result;
                    $preorder->lab_price = $model->lab_price;

                $preorder->save(false);
                // or delete
            }
            
            $searchModel = new PreorderlabSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $model = new Preorderlab(); 
    
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                   return   $this->renderAjax('../../../doctorworkbench/order/pre-order-lab',[
                         'searchModel' => $searchModel,
                         'dataProvider' => $dataProvider,
                         'model' => $model
                         ]);
                 } else {
                    $searchModel = new PcclabSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $model = new Pcclab(); 

                    return $this->redirect('index.php?r=doctorworkbench/order/lab');
                }
            
     }


    public function actionTest(){
          Yii::$app->response->format = Response::FORMAT_JSON;
          $request = Yii::$app->request;
          $data = Yii::$app->request->get('key');
          //return $data;
        return  $this->render('test',['data'=>$data]);
        
    }
}
