<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\education\models\PccServiceEducation */

$this->title = 'Create Pcc Service Education';
$this->params['breadcrumbs'][] = ['label' => 'Pcc Service Educations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pcc-service-education-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
