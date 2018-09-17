<?php

namespace app\modules\doctorworkbench\controllers;
use Yii;
use yii\web\Controller;
use app\modules\doctorworkbench\models\Doctorworkbench;

/**
 * Default controller for the `doctorworkbench` module
 */
class DefaultController extends Controller
{

    public function actionIndex()
    {
        $model = new Doctorworkbench();

        $models = new Doctorworkbench();
        $request = Yii::$app->getRequest();
        if ($request->isPost && $request->post('ajax') !== null) {
            $data = Yii::$app->request->post('Item', []);
            foreach (array_keys($data) as $index) {
                $models[$index] = new Doctorworkbench();
            }
            Model::loadMultiple($models, Yii::$app->request->post());
            Yii::$app->response->format = Response::FORMAT_JSON;
            $result = ActiveForm::validateMultiple($models);
            return $result;
        }




        return $this->render('index',[
            'model' => $models
        ]);
    }
}
