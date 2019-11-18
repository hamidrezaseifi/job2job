<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\lib\JobPositionBase */
/* @var $form yii\widgets\ActiveForm */
/* @var $countries array */
/* @var $vacancies array */
/* @var $worktypes array */
/* @var $branchs array */
/* @var $job2jobComp common\lib\CompanyBase */
/* @var $skills array */
/* @var $companies array */

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
    		<div id="jobpositionbase-company" class="form-control" style="float: left;" ><?=$companyName ?></div>
    		<a ng-click="browsCompany()" class="brows" title=""><i class="fa fa-search"></i></a>
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
            <?= Html::button($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Bearbeiten'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' , 'ng-click' => 'submitForm()']) ?>
        </div>
    
    	<input type="hidden" ng-repeat="skill in jobposition.skillList" name="JobpositionSkills[]" value="{{skill}}">
    	<input type="hidden" ng-repeat="task in jobposition.taskList" name="JobpositionTasks[]" value="{{task}}">
    
        <?php ActiveForm::end(); ?>


    
    
        
    </div>

    <div class="modal fade" id="browsCompaniesModel" tabindex="-1" role="dialog" aria-labelledby="browsCompaniesModelTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Unternehmer auswählen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
    
            <div class="list-group">
            <?php foreach ($companies as $company){?>
              <button type="button" class="list-group-item list-group-item-action" ng-click="selectCompany(<?php echo $company->id;?>, '<?php echo $company->companyname;?>')"><?php echo $company->companyname?></button>
             <?php } ?>
            </div>    
    
          </div>
        </div>
      </div>
    </div>
        
    
    
    <script>

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