<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helper\BrainHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\CompanySearchBase */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Unternehmen');
$this->params['breadcrumbs'][] = $this->title;

$drawmenu = !isset($_GET['nomenu']) || $_GET['nomenu'] != "1";

$actionmenu = $drawmenu ? [
		'class' => 'yii\grid\ActionColumn',
		'headerOptions' => ['style' => 'width : 50px;'],
		'template' => '{view} {update} {delete} {position}',
		'buttons' => [
				'position' => function ($url, $model, $key) {
				return '<a title="' . Yii::t('app', 'Stellenanzeige addieren') . '" href="' . Yii::getAlias('@web') . '/jobpos/create?fromcompany=' . $key . '" ><span class="glyphicon glyphicon-bullhorn"></span></a>';
				},
				],		
] : [
		'class' => 'yii\grid\ActionColumn',
		'headerOptions' => ['style' => 'width : 30px;'],
		'template' => '{select}',
		'buttons' => [
				'select' => function ($url, $model, $key) {
				return '<a href="javascript:selectCompanyList(' . $key . ' , \'' . $model->companyname . '\')" ><span class="glyphicon glyphicon-download"></span></a>';
				},
				],

				];

$createurl = ['create'];
if(!$drawmenu)
{
	$createurl['nomenu'] = 1;
}



?>
<div class="company-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Neues Unternehmen erstellen'), $createurl, ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
            		'class' => 'yii\grid\SerialColumn',
            		'headerOptions' => ['style' => 'width : 50px;'],
            ],

            //'id',
            'companyname',
            //'companytype',
        	[
        		'label' => Yii::t('app', 'Personalentscheider'),
        		//'headerOptions' => ['style' => 'width : 280px;'],
        		'format' => 'html',
        		'value' => function($model){ 
        				$list = $model->personalDecisionMakerList();
        				$res = '';
        	        	if(isset($list[0]))
        				{
        					$res .= $list[0]->getUser()->fullname();	
        				}
        				if(isset($list[1]))
        				{
        					$res .= $res != '' ? '<br>' : '';
        					$res .= Yii::t('app', 'Stellvertreter') . ': ' . $list[1]->getUser()->fullname();
        				}
        				
        				return $res;
        		}
        	],
        	[
        		'label' => Yii::t('app', 'Gründungsdatum'),
        		'headerOptions' => ['style' => 'width : 100px;'],
        		'value' => function($model){ return BrainHelper::dateEnglishToGerman($model->founddate) ;}
        	],
        	[
        		'label' => Yii::t('app', 'Status'),
        		'headerOptions' => ['style' => 'width : 80px;'],
        		'value' => function($model){ return $model->status ? Yii::t('app', 'Aktiv') : Yii::t('app', 'Inaktiv') ;}
        	],
        	//'founddate',
            //'adress:ntext',
            // 'taxid',
            // 'homepage',
            // 'logo',
            // 'employeecountindex',
            // 'status',
            // 'createdate',
            // 'updatedate',

            $actionmenu,
        ],
    ]); ?>
</div>

<script>

	function selectCompanyList(id, name)
	{
		if(typeof window.opener.selectCompany == "function"){
			window.opener.selectCompany(id, name);
			window.close();
		}
			
		
			
	}
	
</script>

