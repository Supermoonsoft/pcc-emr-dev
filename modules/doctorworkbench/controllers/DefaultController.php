<?php

namespace app\modules\doctorworkbench\controllers;

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
        return $this->render('index',[
            'model' => $model
        ]);
    }
}
