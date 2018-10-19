<?php

namespace app\controllers;
use yii\web\Controller;

class PortalController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionEform(){
        return $this->render('eform');
    }

}
