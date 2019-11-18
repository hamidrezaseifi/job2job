<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\lib\UsersBase;

/* @var $this yii\web\View */
/* @var $model common\lib\UsersBase */

$this->title = Yii::t('app', 'Benutzer Anzeigen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Benutzer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$formatter = \Yii::$app->formatter;

?>
<div class="users-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Bearbeiten'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Möchten Sie diesen Artikel wirklich löschen?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'uname',
            'fname',
            'lname',
            [
                'label' => Yii::t('app', 'Geburtsdatum'),
                'value' => $formatter->asDate($model->bdate, 'php:d.m.Y') ,
            ],
            [
        		'label' => Yii::t('app', 'User Type'),
        		'value' => UsersBase::userTypeTitle($model->usertype),
        	],
            //'createdate',
            //'updatedate',
            [
                'label' => Yii::t('app', 'Group'),
                'value' => $model->group0->title,
            ],
            //'permission',
            [
                'label' => 	Yii::t('app', 'Zugriff'),
                'value' => $model->getPermission()->title,
            ],
            [
                'label' => 	Yii::t('app', 'Status'),
                'value' => UsersBase::statusTitle($model->status),
            ],
            
        ],
    ]) ?>

</div>
