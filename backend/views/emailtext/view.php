<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\lib\EmailtextBase */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Emailtext Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Email Text');
?>
<div class="emailtext-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            //'id',
        	'title',
            'text:ntext',
            //'texttype',
            [
        		'label' => 	Yii::t('app', 'Status'),
        		'value' => ($model->status == 1 ? Yii::t('app', 'Active') : Yii::t('app', 'Deactivate')),
        	],
        ],
    ]) ?>

</div>
