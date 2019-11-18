<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\lib\BackMessageBase */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Back Message Base',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Back Message Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Bearbeiten');
?>
<div class="back-message-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
