<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\CallrequestBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Callrequest Bases');
$this->params['breadcrumbs'][] = $this->title;

$helper = new HtmlHelper([
    'controllerName' => 'callrequest',
    'template' => '{view} {delete}',
    
]);

?>
<div class="callrequest-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn','headerOptions' => ['style' => 'width : 60px;'],],

            //'id',
            //'userid',
            [
                'label' => Yii::t('app', 'Benuzer'),
                'headerOptions' => ['style' => 'width : 130px;'],
                'value' => function($model){ return $model->userFullName();}
            ],
            [
                'label' => Yii::t('app', 'Telefone'),
                'headerOptions' => ['style' => 'width : 130px;'],
                'value' => function($model){ return $model->tel;}
            ],
            [
                'label' => Yii::t('app', 'Name'),
                'headerOptions' => ['style' => 'width : 130px;'],
                'value' => function($model){ return $model->name;}
            ],
            [
                'label' => Yii::t('app', 'Nachricht'),
                //'headerOptions' => ['style' => 'width : 130px;'],
                'value' => function($model){ return $model->message;}
            ],
            // 'status',
            [
                'label' => Yii::t('app', 'Erstellung'),
                'headerOptions' => ['style' => 'width : 130px;'],
                'value' => function($model){ return \Yii::$app->formatter->asDate($model->createdate, 'php:d.m.Y H:n'); }
            ],
            
            $helper->render(),
        ],
    ]); ?>
</div>
