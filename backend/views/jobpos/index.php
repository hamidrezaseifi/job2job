<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helper\BrainHelper;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\JobPositionBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stellenanzeige');
$this->params['breadcrumbs'][] = $this->title;

$helper = new HtmlHelper(['controllerName' => 'jobpos']);


/*[
'class' => 'yii\grid\ActionColumn',
'headerOptions' => ['style' => 'width : 70px;'],
'template' => '{find} {update} {view} {delete}',
'buttons' => [
    'find' => function ($url, $model, $key) {
    
    return '<a href="' . Yii::getAlias('@web') . '/jobpos/findcandidate?id=' . $model->id . '" title="' . Yii::t('app', 'Passende Bewerber-Liste') . '" ><span class="glyphicon glyphicon-search"></span></a>';
    },
    ],
    ],*/

?>
<div class="job-position-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Neue Stellenanzeige erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
        		['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width : 80px;'],],
        		[
        			'label' => Yii::t('app', 'Unternehmer'),
        			'headerOptions' => ['style' => 'width : 180px;'],
        			'value' => function($model){ return $model->getCompany()->companyname;}
        		],
        		[
	        		'label' => Yii::t('app', 'Betreff'),
	        		//'headerOptions' => ['style' => 'max-width : 400px;'],
	        		//'format' => 'html',
        			'value' => function($model){ return strlen($model->title) < 60 ? $model->title : substr($model->title, 0 ,58) . ' ...';}
        		],
        		[
	        		'label' => Yii::t('app', 'Ort'),
	        		'headerOptions' => ['style' => 'width : 130px;'],
	        		'value' => function($model){ return $model->postcode . ' ' . $model->city;}
        		],
        		[
	        		'label' => Yii::t('app', 'Gültigkeit'),
	        		'headerOptions' => ['style' => 'width : 100px;'],
	        		'value' => function($model){ return  BrainHelper::dateEnglishToGerman($model->expiredate);}
        		],
        		[
	        		'label' => Yii::t('app', 'Ersteller'),
	        		'headerOptions' => ['style' => 'width : 100px;'],
	        		'value' => function($model){ return  $model->getUser()->one()->fullname();}
        		],
        		[
        			'label' => Yii::t('app', 'Status'),
        			'headerOptions' => ['style' => 'width : 80px;'],
        			'value' => function($model){ return $model->status == 1 ? Yii::t('app', 'bestätigt') : Yii::t('app', 'nicht bestätigt');}
        		],
        		$helper->run()
        		
            
        ],
    ]); ?>
</div>
