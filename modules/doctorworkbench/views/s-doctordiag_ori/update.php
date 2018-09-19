<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\doctorworkbench\models\SDoctordiag */

$this->title = 'Update Sdoctordiag: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sdoctordiags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sdoctordiag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
