<?php

/* @var $this yii\web\View */
/* @var $jobModel \common\lib\JobpositionBase */
/* @var $model \common\lib\UsersBase */
/* @var $modelSecond \common\lib\UsersBase */
/* @var $companyModel \common\lib\CompanyBase */
/* @var $pdmModel \common\lib\PersonaldecisionmakerBase */
/* @var $pdmModelSecond \common\lib\PersonaldecisionmakerBase */
/* @var $skills array */
/* @var $nationalities array */
/* @var $distances array */
/* @var $titles array */
/* @var $companytypes array */
/* @var $worktypes \common\lib\WorktimemodelBase */
/* @var $cellphoneList array */
/* @var $telList array */
/* @var $cellphoneList2 array */
/* @var $telList2 array */
/* @var $reachabilityList array */
/* @var $cities array */
/* @var $postcodes array */
/* @var $vacancies array */
/* @var $branchs array */
/* @var $worktypes array */
/* @var $jobAttributes array */
/* @var $months array */
/* @var $years array */
/* @var $startmonth string */
/* @var $startyear string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helper\BrainStaticList;

$this->registerCssFile("@web/web/css/profileunternehmen.css", [], 'css-profileunternehmen');
$this->registerCssFile("@web/web/css/jobadv.css", [], 'css-jobadv');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerJsFile("@web/web/js/jobadvnew.js", [], 'js-jobadvnew');
$this->registerJsFile("@web/web/js/utils.js", [], 'js-utils');


$currentYear = date('Y');

?>

<div class="register-bewerbung" style="padding-bottom: 20px;" ng-controller="NewAdvController">
    
    <div class="register-bewerbung-title j2jblueback">
    	<?php echo Yii::t('app', 'Neue Anzeige'); ?>
    </div>
    
    <ul class="nav nav-pills mb-2 newjob-tab" id="pills-tab" role="tablist">
  		<li class="nav-item">
    	
    		<a class="nav-link active newjob-tab" id="step1-tab" data-toggle="pill" href="#step1-content" role="tab" aria-controls="step1-content" aria-selected="true">
        		<div class="title"><?php echo Yii::t('app', 'Schritt'); ?> 1</div>
        		<div class="desc"><?php echo Yii::t('app', 'Ihre Anforderung'); ?></div>			
			</a>    		
    	</li>
    	
    	<li class="nav-item">
    		<a class="nav-link newjob-tab" id="step2-tab" data-toggle="pill" href="#step2-content" role="tab" aria-controls="step2-content" aria-selected="false">
        		<div class="title"><?php echo Yii::t('app', 'Schritt'); ?> 2</div>
        		<div class="desc"><?php echo Yii::t('app', 'Rahmenbedingungen'); ?></div>
			</a>    		
    	</li>
    	
    	
    	
    </ul>
<?php $form = ActiveForm::begin(['options' =>['id' => 'formnewadv']])?>
    <div class="job-adv-wizard-container tab-content"  id="steps-tabContent">
    	
	    <div class="tab-pane fade show active" id="step1-content" role="tabpanel" aria-labelledby="step1-tab">
	    	<div class="item-title"><?php echo Yii::t('app', 'Ihre Anforderung'); ?></div>
	    	<div class="content">
	    		<div class="title"><?php echo Yii::t('app', 'Betreff'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Bitte geben Sie einen aussagekräftigen Titel für Ihre Stellenanzeige ein.'); ?></div>
	    		<div class="item"><input class="form-control" type="text" maxlength="80" ng-model="jobposition.title"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Land'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'In welchem Land ist der Jobstandort.'); ?></div>
	    		<div class="item"><input class="form-control" type="text" ng-model="jobposition.country" disabled></div>

	    		<div class="title"><?php echo Yii::t('app', 'Ort'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie den Standort der Stelle ein.'); ?></div>
	    		<div class="item"><input class="form-control" type="text" ng-model="jobposition.city"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Postleitzahl'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie die Postleitzahl der Stelle ein.'); ?></div>
	    		<div class="item"><input class="form-control" type="text" ng-model="jobposition.postcode"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Branchen'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie die Branche der Stelle ein.'); ?></div>
	    		<div class="item">
                    <select class="custom-select custom-select-sm" name="branch" ng-model="jobposition.branch" >
                    	<option ng-repeat="(key, value) in branchs" value="{{key}}">{{value}}</option>
                    </select>	    		
	    		</div>

	    		<div class="title"><?php echo Yii::t('app', 'Aufgaben'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie stichpunktartig die Aufgaben der Stelle ein.'); ?></div>
	    		<div class="item">
    	    		<div class="">
    	    			<input class="form-control add-text-item task-text-item" >
    	    			<button type="button" class="btn addbutton" ng-click="addTask()"><i class="material-icons">playlist_add</i></button>
    	    		</div>
	    			<div class="task-item-container">
	    				<div ng-repeat="task in jobposition.taskList" class="task-item">{{task}} <i ng-click="deleteTask(task)" class="material-icons">delete</i></div>
	    			</div>
	    		</div>

	    		<div class="title"><?php echo Yii::t('app', 'Qualifikationen'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie stichpunktartig die Qualifikationen der Stelle ein.'); ?></div>
	    		<div class="item">
    	    		<div class="">
    	    			<input class="form-control add-text-item skill-text-item" >
    	    			<button type="button" class="btn addbutton" ng-click="addSkill()"><i class="material-icons">playlist_add</i></button>
    	    		</div>
	    			<div class="task-item-container">
	    				<div ng-repeat="skill in jobposition.skillList" class="task-item">{{skill}} <i ng-click="deleteSkill(skill)" class="material-icons">delete</i></div>
	    			</div>
	    		</div>
	    		

	    	</div>
	    </div>
    	
	    <div class="tab-pane fade" id="step2-content" role="tabpanel" aria-labelledby="step2-tab">
	    
	    	<div class="item-title"><?php echo Yii::t('app', 'Rahmenbedingungen'); ?></div>
	    	<div class="content">
	    		<div class="title"><?php echo Yii::t('app', 'Aktuelle Vakanzen'); ?>:*</div>
	    		<div class="item" style="padding-bottom: 10px;">
	    		<?php foreach($vacancies as $id => $title) {?>
                    <div class="custom-control custom-radio custom-control-inline vacany-item">
                      <input type="radio" id="vacancy<?php echo $id; ?>" <?=($id == $jobModel->vacancy ? 'checked' : '')?>  ng-checked="jobposition.vacancy == <?php echo $id; ?>" name="vacancy" class="custom-control-input form-check-input" value="<?php echo $id; ?>" ng-model="jobposition.vacancy">
                      <label class="custom-control-label" for="vacancy<?php echo $id; ?>"><?php echo $title; ?></label>
                    </div>
	    		
	    		<?php } ?>
                    <div class="custom-control custom-radio custom-control-inline vacany-item">
                      <input type="radio" id="vacancySonstige" disabled name="vacancy" class="custom-control-input" value="0" ng-model="jobposition.vacancy" ng-click="otherVacancySelected()">
                      <label class="custom-control-label" for="vacancySonstige">Sonstige</label>
                    </div>
	    		</div>
	    		
				<div class="h-divider"></div>
				
	    		<div class="title"><?php echo Yii::t('app', 'Job-Beginn und Dauer'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Bitte geben Sie den Job-Beginn und die geplante Dauer an.'); ?></div>
	    		<div class="" style="padding-top: 5px; margin-bottom: 10px;">
	    			<div class="custom-control custom-control-inline deadline-item">
		    			<label style="width:50px;"><?php echo Yii::t('app', 'Start'); ?></label>&nbsp;
		    			<select style="height: 26px;" class="custom-select custom-select-sm" ng-model="jobposition.jobStartMonth">
		    				<option value="0">Monat</option>
		    				<option value="1">Januar</option>
		    				<option value="2">Februar</option>
		    				<option value="3">März</option>
		    				<option value="4">April</option>
		    				<option value="5">May</option>
		    				<option value="6">Juni</option>
		    				<option value="7">Juli</option>
		    				<option value="8">August</option>
		    				<option value="9">September</option>
		    				<option value="10">Oktober</option>
		    				<option value="11">November</option>
		    				<option value="12">Dezember</option>
		    			</select>
		    			<select style="height: 26px;" class="custom-select custom-select-sm" ng-model="jobposition.jobStartYear">
		    				<option value="0">Jahr</option>
		    				<?php for($year=$currentYear; $year < $currentYear + 11; $year++){?>
		    				<option value="<?=$year ?>"><?=$year ?></option>
		    				<?php } ?>
		    			</select>
		    			
	    			</div>
	    			<div class="custom-control custom-control-inline deadline-item">
	    				<button type="button" class="fromnow" ng-click="setJobstartNow();">Ab sofort</button>
	    			</div>
	    			<div class="custom-control custom-control-inline deadline-item" style="margin-top: 6px;">
    	    			<div class="custom-control custom-control-inline deadline-item">
    		    			<label style="margin-right: 10px;"><?php echo Yii::t('app', 'Dauer'); ?></label>
    		    			<input ng-model="jobposition.duration" type="number" class="form-control" style="width:70px; height: 26px;">&nbsp;<label><?php echo Yii::t('app', 'Monate'); ?></label>
		    			</div>
                        <div class="custom-control custom-checkbox custom-control-inline deadline-item" style="margin-left: 30px;">
                          <input type="checkbox" class="custom-control-input" id="jobpositionextends" ng-model="jobposition.extends" name="extends" > 
                          <label class="custom-control-label" for="jobpositionextends"><?php echo Yii::t('app', 'Verlängerung möglich'); ?></label>
                        </div>
	    			</div>
	    		</div>

				<div class="h-divider"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Arbeitszeitmodel'); ?>:*</div>
	    		<div class="desc" style="margin-bottom: 10px;"><?php echo Yii::t('app', 'Bitte wählen Sie ein Arbeitszeitmodel für die Stelle aus'); ?></div>
	    		<div class="item" style="margin-bottom: 10px;">
                    <select class="custom-select custom-select-sm" ng-model="jobposition.worktype">
                        <option ng-repeat="(key, value) in worktypes" value="{{key}}">{{value}}</option>
                    </select>	    			
	    		</div>

				<div class="h-divider"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Gültigkeit'); ?>:*</div>
	    		<div class="desc" style="margin-bottom: 10px;"><?php echo Yii::t('app', 'Im folgenden können Sie ein Gültigkeitsdatum eintragen. Nach diesem Datum wird Ihre Stellenanzeige nicht mehr im Verzeichnis gelistet'); ?></div>
	    		<div class="item" style="padding-bottom: 10px;">
	    			<label style="width:100px; "><?php echo Yii::t('app', 'Gültigkeit: '); ?></label>&nbsp;
	    			<input ng-model="jobposition.expiredate" id="jobpositionexpiredate" type="text" style="width:140px; height: 26px;">
	    		</div>

				<div class="h-divider"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Notiz'); ?>:</div>
	    		<div class="desc" style="margin-bottom: 10px;"><?php echo Yii::t('app', 'Geben Sie eine Notiz für die Stelle an. Diese wird nur für Job2Job Mitarbeiter sichtbar sein.'); ?></div>
	    		<div class="item" style="padding-bottom: 10px;">
					<textarea ng-model="jobposition.comments" style="width:90%; height: 150px;"></textarea>	    			
	    		</div>

				<div class="h-divider"></div>

        		<?php if($jobModel->isNewRecord) {?>
            	<div class="apply-condition1">
            		<div class="custom-control custom-checkbox">
            			<input type="checkbox" class="custom-control-input" id="checkcondition" name="checkcondition" ng-model="checkcondition" />
            		    <label ng-class="{ 'condition-disbaled': checkcondition == false,  'condition-enabled': checkcondition == true}" for="checkcondition" class="custom-control-label">Ja, ich habe die <a href="#">Nutzungsbedingungen</a> gelesen und stimme diesen zu. Die <a target="_blank" href="<?php echo Yii::getAlias("@web") ?>/site/privacypolicy">Datenschutzerklärung</a> habe ich zur Kenntnis genommen.</label>
        			</div>
            	</div>
            	<?php } ?>

	    	</div>
	    </div>
    	    	
    </div>
    
	<div class="nav-button-set">
		<div class="button cancel" ng-click="cancelAdv()"><?php echo Yii::t('app', 'abbrechen'); ?></div>
		<div class="button next" ng-click="nextWizard()"><?php echo Yii::t('app', 'weiter'); ?></div>
		<div class="button prev" ng-click="prevWizard()"><?php echo Yii::t('app', 'zurück'); ?></div>
		<div class="buttonapply" ng-click="createAdv()"><?php echo Yii::t('app', 'Stellenanzeige speichern und veröffentlichen'); ?></div>
		<div class="clear"></div>
	</div>
    
<?php ActiveForm::end() ?>

</div>


<script type="text/javascript">

var jobposition = <?php print (json_encode ( $jobAttributes )) ; ?>;
var jobStartMonth = "<?php print $startmonth ; ?>";

var branchs = <?php print (json_encode ( $branchs )) ; ?>;
var worktypes = <?php print (json_encode ( $worktypes )) ; ?>;
var title_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Titel für Ihre Stellenanzeige im ersten Schritt ein!'); ?>";
var country_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie das Land der Stelle beim ersten Schritt aus!'); ?>";
var city_msg = "<?php echo Yii::t('app', 'Geben Sie den Standort der Stelle beim ersten Schritt ein!'); ?>";
var postcode_msg = "<?php echo Yii::t('app', 'Geben Sie die Postleitzahl der Stelle beim ersten Schritt ein!'); ?>";
var comment_msg = "<?php echo Yii::t('app', 'Bitte beschreiben Sie Ihre Stelle beim ersten Schritt möglichst detailliert!'); ?>";
var vacancy_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie die Vakanz der Stelle beim zweiten Schritt aus!'); ?>";
var worktype_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie ein Arbeitszeitmodel für die Stelle aus!'); ?>";
var jobdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Job-Beginn und die geplante Dauer beim zweiten Schritt an!'); ?>";
var expire_msg = "<?php echo Yii::t('app', 'Bitte geben Sie die Gültigkeit der Stellenanzeige beim zweiten Schritt an!'); ?>";
var condition_msg = "<?php echo Yii::t('app', 'Bitte stimmen Sie den Nutzungsbedingungen und der Datenschutzerklärung zu!'); ?>";
var skill_exists_msg = '<?php echo Yii::t('app', 'Das Schlagwort "%" existiert bereits in der Liste!'); ?>';
var skill_msg = '<?php echo Yii::t('app', 'Bitte geben Sie mindestens eine Qualifikation im ersten Schritt ein!'); ?>';
var task_msg = '<?php echo Yii::t('app', 'Bitte geben Sie mindestens eine Aufgabe im ersten Schritt ein!'); ?>';
var branch_msg = "<?php echo Yii::t('app', 'Geben Sie die Branche der Stelle beim ersten Schritt ein!'); ?>";

var advlisturl = "<?php echo YII::getAlias('@web')?>/company/dashboard/jobs";
var advsaveurl = "<?php echo YII::getAlias('@web')?>/company/dashboard/savejob";

var allskils = new Array();
var skilltypelist = new Array();

var taskList = [<?php echo ('"' . implode('","', $selectedTasks) . '"');  ?>];
var skillList = [<?php echo ('"' . implode('","', $selectedSkills) . '"');  ?>];

  
</script>

