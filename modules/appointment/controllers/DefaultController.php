<?php

namespace app\modules\appointment\controllers;

use yii\web\Controller;
use app\modules\appointment\models\PccAppoinmentShow;
/**
 * Default controller for the `appointment` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $events = PccAppoinmentShow::find()->all();
        
        $masker = [];
        foreach ($events as $eve) {
            
            $event = new \yii2fullcalendar\models\Event();
            $event->id = $eve->id;
            $event->title ='test';
            $event->start = $eve->startdate;
            $event->end = $eve->enddate;
            $event->backgroundColor = $eve->color;
            $masker[] = $event;
        }


        return $this->render('index', [
                    'events' => $masker,
        ]);
    }
}
