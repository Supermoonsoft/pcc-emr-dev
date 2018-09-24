<?php

namespace app\modules\queuemanage\controllers;

use yii\web\Controller;
use app\components\DbHelper;

/**
 * Default controller for the `queuemanage` module
 */
class AjaxController extends Controller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionLab($cid=null) {
        
        //$array[] = ['cid'=>$cid];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $sql = " SELECT t.lab_name,t.lab_result,t.standard_result from pcc_lab t LIMIT 10 ";
        $raw = DbHelper::queryAll('db', $sql);
        
        return $raw;
    }

    public function actionLabView($cid=null){
    //$array[] = ['cid'=>$cid];
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $sql = " SELECT t.lab_name,t.lab_result,t.standard_result from pcc_lab t LIMIT 10 ";
    $raw = DbHelper::queryAll('db', $sql);

    return $this->renderAjax('../default/lab_view',['raw' => $raw]);
    }

}
