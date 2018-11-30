<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\PersonaldecisionmakerBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Personalentscheider');
$this->params['breadcrumbs'][] = $this->title;

$drawmenu = !isset($_GET['nomenu']) || $_GET['nomenu'] != "1";

$actionmenu = $drawmenu ? [
	            	'class' => 'yii\grid\ActionColumn',
	            	'headerOptions' => ['style' => 'width : 50px;'],
	           		'template' => '{view} {update} {delete} {password}',
                    'buttons' => ['password' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url , ['title' => Yii::t('app', 'Set Password') , 'aria-label' => Yii::t('app', 'Set Password'), ]);
                    },],
	        	] : [
	            	'class' => 'yii\grid\ActionColumn',
	            	'headerOptions' => ['style' => 'width : 50px;'],
	           		'template' => '{select}',
        			'buttons' => [
        					'select' => function ($url, $model, $key) {
        					return '<a href="javascript:selectPetList(' . $key . ' , \'' . $model->title . ' ' . $model->getUser()->fullname() . '\', ' . $model->isdeputy . ')" ><span class="glyphicon glyphicon-download"></span></a>';
        					},
        					],
	        			
	        	];
	        	
$createurl = ['create'];
if(!$drawmenu)
{
	$createurl['nomenu'] = 1;
}
if(isset($_GET['sv']))
{
	$createurl['sv'] = $_GET['sv'];
}
?>
<div class="personaldecisionmaker-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Neuen Personalentscheider erstellen'), $createurl, ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
        		['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width : 80px;'],],
        		[
        				'label' => Yii::t('app', 'Vollname'),
        				//'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return $model->title . ' ' . $model->getUser()->fullname();}
        		],
        		[
	        		'label' => Yii::t('app', 'Unternehmer'),
	        		'headerOptions' => ['style' => 'width : 130px;'],
	        		'value' => function($model){ $comp = $model->getCompany(); return $comp && $comp != null ? $comp->companyname : Yii::t('app', 'nicht eingestellt') ;}
        		],
        		[
	        		'label' => Yii::t('app', 'Herstellungsdatum'),
	        		'headerOptions' => ['style' => 'width : 130px;'],
	        		'value' => function($model){ return \Yii::$app->formatter->asDate($model->createdate , 'php:d.m.Y');}
        		],
	        	$actionmenu,
        ],
    ]); ?>
</div>

<script>

	function selectPetList(id, name, isdep)
	{
		if(isdep == 0 && typeof window.opener.selectPet == "function"){
			window.opener.selectPet(id, name);
			window.close();
		}
			
		if(isdep == 1 && typeof window.opener.selectSV == "function"){
			window.opener.selectSV(id, name);
			window.close();
		}
			
	}
	
</script>

