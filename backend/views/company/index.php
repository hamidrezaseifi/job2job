<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helper\BrainHelper;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\CompanySearchBase */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Unternehmen');
$this->params['breadcrumbs'][] = $this->title;

$helper = new HtmlHelper([
    'controllerName' => 'company', 
    'visibleButtons' => [
        'update' => function ($model, $key, $index) {
        return $model->isjob2job === 0;
        },
        'delete' => function ($model, $key, $index) {
        return $model->isjob2job === 0;
        },
        'view' => function ($model, $key, $index) {
        return $model->isjob2job === 0;
        },
     ]
    
]);

function getSetPasswordLink($model){
    return '<a style="margin-left: 10px;" href="' . Yii::getAlias('@web') . '/company/password?id=' . $model->userid . '" title="Set Password" aria-label="Set Password"><span class="glyphicon glyphicon-lock"></span></a>';
}

?>
<div class="company-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Neues Unternehmen erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
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
        					$res .= getSetPasswordLink($list[0]);
        				}
        				if(isset($list[1]))
        				{
        					$res .= $res != '' ? '<br>' : '';
        					$res .= Yii::t('app', 'Stellvertreter') . ': ' . $list[1]->getUser()->fullname();
        					$res .= getSetPasswordLink($list[1]);
        				}
        				
        				return $res;
        		}
        	],
        	[
        		'label' => Yii::t('app', 'Gründungsdatum'),
        		'headerOptions' => ['style' => 'width : 100px;'],
        		'value' => function($model){ return BrainHelper::dateAsGerman($model->founddate) ;}
        	],
        	[
        		'label' => Yii::t('app', 'Status'),
        		'headerOptions' => ['style' => 'width : 80px;'],
        		'value' => function($model){ return $model->status ? Yii::t('app', 'Aktiv') : Yii::t('app', 'Inaktiv') ;}
        	],

        	$helper->run(),
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

