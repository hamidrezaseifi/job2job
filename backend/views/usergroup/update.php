<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\UsergroupBase */
/* @var $status_list array */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User Group',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Group'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="user-group-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'status_list' 		=> $status_list,
    ]) ?>

</div>
