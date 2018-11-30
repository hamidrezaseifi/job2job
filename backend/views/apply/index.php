<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use common\helper\BrainStaticList;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\CandidatejobapplyBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $status integer */
/* @var $candidateid integer */
/* @var $jobposid integer */
/* @var $companyid integer */
/* @var $candidatename string */
/* @var $jobpostitle string */
/* @var $companyname string */

$this->title = Yii::t('app', 'Bewerbungen');
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile("@web/web/css/apply.css", [], 'css-apply');
$this->registerJsFile("@web/web/js/apply.js", [], 'js-apply');

$statuslist = array(-1 => Yii::t('app', 'Alle'), 0 => Yii::t('app', 'Neu'), 1 => Yii::t('app', 'Archiv'));



?>
<div class="candidatejobapply-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
 
	<?php $form = ActiveForm::begin(['id' => 'statusform', 'method' => 'GET', 'action' => Yii::getAlias('@web') . '/apply/index' ]); ?>
	<?php echo Html::hiddenInput('candidate' , $candidateid, ['id' => 'candidateid'])?>
	<?php echo Html::hiddenInput('jobpos' , $jobposid, ['id' => 'jobposid'])?>
	<?php echo Html::hiddenInput('company' , $companyid, ['id' => 'companyid'])?>
	<?php echo Html::hiddenInput('status' , $status, ['id' => 'candidateid'])?>

	<?php ActiveForm::end(); ?>

	
	<div class="filter-container">
		<div onchange="filterall();" class="form-control status-container">
			<label><?php echo Yii::t('app', 'Status')?></label> &nbsp; &nbsp; &nbsp; 
			<?php foreach ($statuslist as $key => $label) {?>
			<label><?php echo $label;?> <input type="radio" name="statuslist" value="<?php echo $key;?>" <?php if($key == $status){ ?>checked="checked" <?php } ?> > </label> &nbsp;
			<?php } ?>
		
		</div>

		<div class="form-control company-container">
			<label><?php echo Yii::t('app', 'Unternehmer');?> </label>
			<div id="companytext" class="form-control name" ><?php echo $companyname;?></div>		
			<a href="javascript:browsCompany()" class="brows" title=""><span class="glyphicon glyphicon-search"></span></a>
			<a href="javascript:clearCompany()" class="remove" title=""><span class="glyphicon glyphicon-remove"></span></a>
			
		</div>

		<div class="form-control candidate-container">
			<label><?php echo Yii::t('app', 'Bewerber');?> </label>
			<div id="candidatetext" class="form-control name" ><?php echo $candidatename;?></div>		
			<a href="javascript:browsCandidate()" class="brows" title=""><span class="glyphicon glyphicon-search"></span></a>
			<a href="javascript:clearCandidate()" class="remove" title=""><span class="glyphicon glyphicon-remove"></span></a>
			
		</div>

		<div class="clear"></div>

		<div class="form-control jobpos-container">
			<label><?php echo Yii::t('app', 'Stellenanzeige');?> </label>
			<div id="jobpostext" class="form-control name" ><?php echo $jobpostitle;?></div>		
			<a href="javascript:browsJobposition()" class="brows" title=""><span class="glyphicon glyphicon-search"></span></a>
			<a href="javascript:clearJobposition()" class="remove" title=""><span class="glyphicon glyphicon-remove"></span></a>
			
		</div>


		<div class="clear"></div>
	</div>


	  
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width : 40px;'],],
        	[
        		'label' => Yii::t('app', 'Bewerber'),
        		'headerOptions' => ['style' => 'width : 130px;'],
        		'format' => 'raw',
        		'value' => function($model){ return $model->getCandidate()->title . ' ' . $model->getUser()->fullname() . ' <a target="_blank" href="' . Yii::getAlias('@web') . '/candidate/view?id=' . $model->userid . '"><span class="glyphicon glyphicon-new-window"></span></a>';}
        	],
        	[
        		'label' => Yii::t('app', 'Stellenanzeige'),
        		'format' => 'raw',
        		'value' => function($model){ return $model->getJobpos()->title . ' <a target="_blank" href="' . Yii::getAlias('@web') . '/jobpos/view?id=' . $model->jobposid . '"><span class="glyphicon glyphicon-new-window"></span></a>';}
        	],
        	[
        		'label' => Yii::t('app', 'Status'),
        		'format' => 'raw',
        		'headerOptions' => ['style' => 'width : 70px;'],
        		'value' => function($model){ return $model->status == 0 ? Yii::t('app', 'Neu') : Yii::t('app', 'Archiv');}
        	],
        	/*'userid',
            'jobposid',
            'status',
            'createdate',*/

            [
            	'class' => 'yii\grid\ActionColumn',
            	'headerOptions' => ['style' => 'width : 70px;'],
            	'template' => '{archive} {view} {delete}',
            	'buttons' => [
            		'archive' => function ($url, $model, $key) {
            			$status = isset($_GET['status']) ? $_GET['status'] : -1;
            			return $model->status == 1  ? '' : '<a href="' . Yii::getAlias('@web') . '/apply/archive?userid=' . $model->userid . '&jobposid=' . $model->jobposid . '&status=' . $status . '" title="' . Yii::t('app', 'Archiv') . '" ><span class="glyphicon glyphicon-floppy-save"></span></a>';
            		},
            	],
    		],
        ],
    ]); ?>
</div>

<div id="dvbrowscompany">
	<div class="text-container">
		<?php $form = ActiveForm::begin(['method' => 'GET', 'action' => Yii::getAlias('@web') . '/company/search' ]); ?>
		<input id="txtbrowscompany" class="form-control" name="name" onkeyup="searchList(this, 'companyid');" maxlength="30">
		<?php ActiveForm::end(); ?>
	</div>
	<div class="form-control listcontainer">
		<img alt="" class="loading" src="<?php echo Yii::getAlias('@web') ?>/web/images/loading.gif" >
		<ul class="list">
		</ul>
	</div>
</div>

<div id="dvbrowscandidate">
	<div class="text-container">
		<?php $form = ActiveForm::begin(['method' => 'GET', 'action' => Yii::getAlias('@web') . '/candidate/search' ]); ?>
		<input id="txtbrowscandidate" class="form-control" name="name" onkeyup="searchList(this, 'candidateid');" maxlength="30">
		<?php ActiveForm::end(); ?>
	</div>
	<div class="form-control listcontainer">
		<img alt="" class="loading" src="<?php echo Yii::getAlias('@web') ?>/web/images/loading.gif" >
		<ul class="list">
		</ul>
	</div>
</div>

<div id="dvbrowsjobpos">
	<div class="text-container">
		<?php $form = ActiveForm::begin(['method' => 'GET', 'action' => Yii::getAlias('@web') . '/jobpos/search' ]); ?>
		<input id="txtbrowsjobpos" class="form-control" name="name" onkeyup="searchList(this, 'jobposid');" maxlength="30">
		<?php ActiveForm::end(); ?>
	</div>
	<div class="form-control listcontainer">
		<img alt="" class="loading" src="<?php echo Yii::getAlias('@web') ?>/web/images/loading.gif" >
		<ul class="list">
		</ul>
	</div>
</div>

