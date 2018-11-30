<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\EmailtextBase */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Emailtext Base',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emailtext Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="emailtext-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
