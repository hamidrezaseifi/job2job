<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\FrontlogBase */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Frontlog Base',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frontlog Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'userid' => $model->userid]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="frontlog-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
