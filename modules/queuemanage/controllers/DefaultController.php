<?php

namespace app\modules\queuemanage\controllers;

use yii\web\Controller;
use app\components\DbHelper;

/**
 * Default controller for the `queuemanage` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $sql = "select 1";
        $raw = DbHelper::queryAll('db', $sql);
        return $this->render('index');
    }
}
