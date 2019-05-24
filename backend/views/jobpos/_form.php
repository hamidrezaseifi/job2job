<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\lib\JobPositionBase */
/* @var $form yii\widgets\ActiveForm */

$companyName = '';
$companyID = 0;

$canSelectCompany = true;
if($model->isNewRecord == false && $model->userid != Yii::$app->user->identity->id)
{
	$canSelectCompany = false;
}

if($model->companyid != null)
{
	$company = $model->getCompany();
	if($company)
	{
		$companyName = $company->companyname;
		$companyID = $company->id;
	}
}

$this->registerCssFile("@web/web/css/jobpos-form.css", [], 'css-jobpos-form');
$this->registerJsFile("@web/web/js/jobpos-form.js", ['position' => \yii\web\View::POS_END], 'js-jobpos-form');

?>

<div ng-controller="JobPosController">
    <div class="job-position-base-form">
    
        <?php $form = ActiveForm::begin(['id' => 'jobposform']); ?>
    
    
    	<div class="form-group field-st" style="height: 55px;">
    		<label class="control-label" disabled for="companybase-employeecountindex"><?=Yii::t('app', 'Unternehmer')?></label>
    		<input type="radio" name="isjob2job" value="0" ng-checked="!isJob2Job" ng-click="setJob2Job(false)" >
    		&nbsp; &nbsp; &nbsp; 
    		<label class="control-label" for="companybase-employeecountindex"><?=Yii::t('app', 'Job2Job')?></label>
    		<input type="radio" name="isjob2job" value="1" ng-checked="isJob2Job" ng-click="setJob2Job(true)" >
    		<div id="jobpositionbase-company" class="form-control" style="float: left;" ><?=$companyName ?></div>
    		<?php if($canSelectCompany) {?>
    		<a ng-click="browsCompany()" class="brows" ng-if="!isJob2Job" title=""><span class="glyphicon glyphicon-search"></span></a>
    		<a href="javascript:clearCompany()" class="remove" ng-if="!isJob2Job && companyId > 0" title=""><span class="glyphicon glyphicon-remove"></span></a>
    		<?php } ?>
    		<div class="clear"></div>
    		<input type="hidden" id="jobpositionbase-companyid" name="JobpositionBase[companyid]" value="<?=$companyID ?>">
    	</div>
    
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'postcode')->textInput(['maxlength' => true, 'type' => 'number']) ?>
    
        <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    
        <?= $form->field($model, 'country')->dropDownList($countries) ?>
    
        <?= $form->field($model, 'vacancy')->dropDownList($vacancies) ?>
    
        <?= $form->field($model, 'jobstartdate')->textInput(['class' => 'form-control calender-icon', 'id' => 'jobstartdate']) ?>
    
        <?= $form->field($model, 'duration')->textInput(['type' => 'number']) ?>
    
        <?= $form->field($model, 'extends')->checkbox() ?>
    
        <?= $form->field($model, 'expiredate')->textInput(['class' => 'form-control calender-icon', 'id' => 'expiredate']) ?>
    
        <?= $form->field($model, 'worktype')->dropDownList($worktypes) ?>
    
        <?= $form->field($model, 'branch')->dropDownList($branchs) ?>
    
        <?= $form->field($model, 'status')->radioList([0 => Yii::t('app', 'nicht bestätigt'), 1 => Yii::t('app', 'bestätigt'), 2 => Yii::t('app', 'Inaktiv')]) ?>
    
        <?= $form->field($model, 'comments')->textarea(['rows' => 5, 'id' => 'commentstext'])->label('Notiz') ?>
        
		<div class="title"><?php echo Yii::t('app', 'Aufgaben'); ?>:*</div>
		<div class="desc"><?php echo Yii::t('app', 'Geben Sie die Aufgaben der Stelle ein.'); ?></div>
		<div class="list-container">
    		<div class="">
    			<input class="add-text-item task-text-item" ng-keypress="enterTaskKeyboard($event)" >
    			<button type="button" class="addbutton" ng-click="addTask()"><b style="font-size: 18px">+</b>  <?php echo Yii::t('app', 'hinzufügen'); ?></button>
    		</div>
			<div class="task-item-container">
				<div ng-repeat="task in jobposition.taskList" class="task-item">{{task}} <i ng-click="deleteTask(task)" class="material-icons">delete</i></div>
			</div>
		</div>

		<div class="title"><?php echo Yii::t('app', 'Qualifikationen'); ?>:*</div>
		<div class="desc"><?php echo Yii::t('app', 'Geben Sie die Qualifikationen der Stelle ein.'); ?></div>
		<div class="list-container">
    		<div class="">
    			<input class="add-text-item skill-text-item" ng-keypress="enterSkillKeyboard($event)" >
    			<button type="button" class="addbutton" ng-click="addSkill()"><b style="font-size: 18px">+</b>  <?php echo Yii::t('app', 'hinzufügen'); ?></button>
    		</div>
			<div class="task-item-container">
				<div ng-repeat="skill in jobposition.skillList" class="task-item">{{skill}} <i ng-click="deleteSkill(skill)" class="material-icons">delete</i></div>
			</div>
		</div>
	    		        
        <div class="form-group">       
            <?= Html::button($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' , 'ng-click' => 'submitForm()']) ?>
        </div>
    
    	<input type="hidden" ng-repeat="skill in jobposition.skillList" name="JobpositionSkills[]" value="{{skill}}">
    	<input type="hidden" ng-repeat="task in jobposition.taskList" name="JobpositionTasks[]" value="{{task}}">
    
        <?php ActiveForm::end(); ?>
    
    </div>
    
    <div id="dvbrowscompany">
    	<div class="text-container">
    		<?php $form = ActiveForm::begin(['method' => 'GET', 'action' => Yii::getAlias('@web') . '/company/search' ]); ?>
    		<input id="txtbrowscompany" class="form-control" name="name" onkeyup="searchList(this);" maxlength="30">
    		<?php ActiveForm::end(); ?>
    	</div>
    	<div class="form-control listcontainer">
    		<img alt="" class="loading" src="<?php echo Yii::getAlias('@web') ?>/web/images/loading.gif" >
    		<ul class="list">
    		</ul>
    	</div>
    </div>
    
    
    
    <script>
    $(document).ready(function(){
    	<?php if($companyID == 0) {?>
    	$("a.remove").hide();
    	<?php } ?>
    });

    var isJob2Job = <?php echo $model->isCompanyJob2Job() ? 'true' : 'false';?>;
    var job2JobId = <?php echo $job2jobComp->id;?>;
    var job2JobTitle = "<?php echo $job2jobComp->companyname;?>";
    var companyId = <?php echo $companyID;?>;

    var allskils = new Array();
    <?php foreach ($skills as $id => $skill){?>
    allskils.push("<?php echo $skill;?>");
    <?php } ?>
    
    var jobskills = new Array();
    <?php foreach ($model->getJobpositionskills() as $skill){?>
    jobskills.push("<?php echo $skill->skill;?>");
    <?php } ?>
    
    var jobtasks = new Array();
    <?php foreach ($model->getJobpositiontasks() as $task){?>
    jobtasks.push("<?php echo $task->task;?>");
    <?php } ?>
        
    </script>

</div>