<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\lib\TargetMessageUsersBase */

$this->title = $model->userid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Target Message Users Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-message-users-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Bearbeiten'), ['update', 'id' => $model->userid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->userid], [
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
            //'userid',
        	[
        		'label' => 	Yii::t('app', 'User'),
        		'value' => $model->user->fullname() ,
        	],        		
            [
        		'label' => 	Yii::t('app', 'Status'),
        		'value' => ($model->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', Inaktiv)),
        	],
        ],
    ]) ?>

</div>
