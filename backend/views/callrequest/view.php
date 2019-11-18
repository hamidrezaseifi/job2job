<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\lib\CallrequestBase */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rückruf Antrag'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$formatter = \Yii::$app->formatter;


?>
<div class="callrequest-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'aria-label' => 'Löschen',
            'data' => [
                'confirm' => Yii::t('app', 'Möchten Sie diesen Artikel wirklich löschen?'),
                'method' => 'post',
                'pjax' => 0
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
