<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CandidateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bewerber');
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="candidate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Neuen Bewerber erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => false,
        'columns' => [
        		['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width : 80px;'],],
        		[
        				'label' => Yii::t('app', 'Vollname'),
        				//'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return $model->title . ' ' . $model->user()->fullname();}
        		],
        		[
        				'label' => Yii::t('app', 'Herstellungsdatum'),
        				'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return \Yii::$app->formatter->asDate($model->createdate , 'php:d.m.Y');}
        		],
        		[
        				'label' => Yii::t('app', 'Status'),
        				'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return $model->user()->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', 'Deaktiv');}
        		],
        		[
        		    'class' => 'yii\grid\ActionColumn' ,
        		    'headerOptions' => ['style' => 'width : 90px;'],
        		    'template' => '{view} {update} {delete} {password}',
        		    'buttons' => ['password' => function ($url, $model, $key) {
        		    return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url , ['title' => Yii::t('app', 'Set Password') , 'aria-label' => Yii::t('app', 'Set Password'), ]);
        		    },],
        		],
        ],
    ]); ?>
</div>
