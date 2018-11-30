<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helper\BrainStaticList;

/* @var $this yii\web\View */
/* @var $model common\lib\PersonaldecisionmakerBase */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personaldecisionmaker Bases'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personaldecisionmaker-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->userid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->userid], [
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
            //'companyid',
        	[
        		'label' => Yii::t('app', 'Unternehmer'),
        		'format' => 'raw',
        		'value' => $model->getCompany()->companyname . ' <a target="_blank" href="' . Yii::getAlias('@web') . '/company/view?id=' . $model->companyid . '"><span class="glyphicon glyphicon-new-window"></span></a>',
        	],
            'title',
            'title2',
        	[
        		'label' => Yii::t('app', 'Vollname'),
        		'format' => 'raw',
        		'value' => $model->getUser()->fullname(),
        	],
        	'email:email',
            'cellphone',
            'tel',
        	[
        		'label' => $model->getUser()->attributeLabels()['receive_backend_email'],
        		'value' => BrainStaticList::janeinList(false)[$model->getUser()->receive_backend_email],
        	],
        	'reachability',
            'contacttime',
            //'isdeputy',
        	[
        		'label' => Yii::t('app', 'Rolle'),
        		'format' => 'raw',
        		'value' => $model->isdeputy ? Yii::t('app', 'Stellvertreter') : Yii::t('app', 'Personalentscheider'),
        	],
        		//'status',
            //'createdate',
            //'updatedate',
        ],
    ]) ?>

</div>
