<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\lib\CallrequestBase */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Callrequest Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$formatter = \Yii::$app->formatter;


?>
<div class="callrequest-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'userid',
            [
                'label' => Yii::t('app', 'Benuzer'),
                'value' => $model->userFullName() ,
            ],
            'tel',
            'name',
            'message',
            //'status',
            [
                'label' => Yii::t('app', 'Erstellung'),
                'value' => $formatter->asDate($model->createdate, 'php:d.m.Y H:n') ,
            ],
        ],
    ]) ?>

</div>
