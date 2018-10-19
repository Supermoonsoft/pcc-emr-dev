<?php

namespace app\modules\eform\controllers;

use yii\web\Controller;

/**
 * Default controller for the `eform` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
