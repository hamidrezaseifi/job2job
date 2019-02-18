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

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\helper\BrainHelper;
use common\helper\BrainStaticList;

$this->registerCssFile("@web/web/css/profileunternehmen.css", [], 'css-profileunternehmen');
$this->registerCssFile("@web/web/css/jobadv.css", [], 'css-jobadv');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
//$this->registerJsFile("@web/web/js/profileunternehmen.js", [], 'js-profileunternehmen');
$this->registerJsFile("@web/web/js/jobadvnew.js", [], 'js-jobadvnew');

$this->registerCssFile("@web/web/css/froala/froala_editor.css", [], 'css-froala_editor');
$this->registerCssFile("@web/web/css/froala/froala_style.css", [], 'css-froala_style');
$this->registerCssFile("@web/web/css/froala/plugins/code_view.css", [], 'css-code_view');
$this->registerCssFile("@web/web/css/froala/plugins/colors.css", [], 'css-froala-colors');
$this->registerCssFile("@web/web/css/froala/plugins/line_breaker.css", [], 'css-froala_line_breaker');
$this->registerCssFile("@web/web/css/froala/plugins/char_counter.css", [], 'css-froala_char_counter');
$this->registerCssFile("@web/web/css/froala/font-awesome.min.css", [], 'css-froala_font-awesome');
$this->registerCssFile("@web/web/css/froala/codemirror.min.css", [], 'css-froala_codemirror');

$this->registerJsFile("@web/web/js/froala/froala_editor.min.js", [], 'js-froala_editor');
$this->registerJsFile("@web/web/js/froala/plugins/align.min.js", [], 'js-froala-align');
$this->registerJsFile("@web/web/js/froala/plugins/char_counter.min.js", [], 'js-froala-char_counter');
$this->registerJsFile("@web/web/js/froala/plugins/code_beautifier.min.js", [], 'js-froala-');
$this->registerJsFile("@web/web/js/froala/plugins/code_view.min.js", [], 'js-froala-code_view');
$this->registerJsFile("@web/web/js/froala/plugins/colors.min.js", [], 'js-froala-colors');
$this->registerJsFile("@web/web/js/froala/plugins/draggable.min.js", [], 'js-froala-draggable');
$this->registerJsFile("@web/web/js/froala/plugins/font_size.min.js", [], 'js-froala-font_size');
$this->registerJsFile("@web/web/js/froala/plugins/font_family.min.js", [], 'js-froala-font_family');
$this->registerJsFile("@web/web/js/froala/plugins/inline_style.min.js", [], 'js-froala-inline_style');
$this->registerJsFile("@web/web/js/froala/plugins/lists.min.js", [], 'js-froala-lists');
$this->registerJsFile("@web/web/js/froala/plugins/paragraph_format.min.js", [], 'js-froala-paragraph_format');
$this->registerJsFile("@web/web/js/froala/plugins/paragraph_style.min.js", [], 'js-froala-paragraph_style');
$this->registerJsFile("@web/web/js/froala/plugins/quote.min.js", [], 'js-froala-quote');

Yii::$app->formatter->locale = 'de-DE';
$months = array(0 => '--' . Yii::t('app', 'Monath') . '--');
for ($i = 1; $i < 13; $i++) {	
	$months[$i] = Yii::$app->formatter->asDate('2014-' . $i . '-1' , 'php:F');
}
$thisyear = intval(date('Y')); 
$years = array(0 => '--' . Yii::t('app', 'Jahr'));
for($i =0; $i<10; $i++)
{
	$years[$thisyear] = $thisyear;
	$thisyear ++;
}

$startmonth = ''; 
$startyear = '';
$startdate = $jobModel->jobstartdate;
if(strlen($startdate) >= 10 )
{
	$startyear = intval(substr($startdate , 0 , 4));
	$startmonth= intval(substr($startdate , 5 , 2));
}

$jobModel->expiredate = BrainHelper::dateEnglishToGerman($jobModel->expiredate);

?>
<div class="register-bewerbung" style="padding-bottom: 20px;" ng-controller="NewAdvController">
    
    <div class="register-bewerbung-title j2jgreenback">
    	<?php echo Yii::t('app', 'Neue Anzeige'); ?>
    </div>
    
    <div class="top-wizard-nave">
    	<div class="nav-item">
    		<div class="title"><?php echo Yii::t('app', 'Schritt'); ?> 1</div>
    		<div class="desc"><?php echo Yii::t('app', 'Ihre Anforderung'); ?></div>
    	
    	</div>
    	
    	<div class="nav-item-sep"></div>
    	
    	<div class="nav-item">
    		<div class="title"><?php echo Yii::t('app', 'Schritt'); ?> 2</div>
    		<div class="desc"><?php echo Yii::t('app', 'Raumen Bedingungen'); ?></div>
    	
    	</div>
    	
    	<div class="clear"></div>
    	
    </div>
<?php $form = ActiveForm::begin(['options' =>['id' => 'formnewadv']])?>
    <div class="job-adv-wizard-container">
    	
	    <div class="job-adv-wizard-item wizard-item1">
	    	<div class="item-title"><?php echo Yii::t('app', 'Ihre Anforderung'); ?></div>
	    	<div class="content">
	    		<div class="title"><?php echo Yii::t('app', 'Betreff'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Bitte geben Sie einen aussagekraftigen Title für Ihre Anzeigeausschreibung ein.'); ?></div>
	    		<div class="item"><?=Html::textInput('title', $jobModel->title, ['maxlength' => 80, ]) ?></div>

	    		<div class="title"><?php echo Yii::t('app', 'Land'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'In welchem Land ist der Jobstandort.'); ?></div>
	    		<div class="item"><?=Html::textInput('country', $jobModel->country, ['readonly' => 'readonly', 'disabled' => true]) ?></div>

	    		<div class="title"><?php echo Yii::t('app', 'Ort'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie den Standort der Stelle ein.'); ?></div>
	    		<div class="item"><?=Html::textInput('city', $jobModel->city) ?></div>

	    		<div class="title"><?php echo Yii::t('app', 'Postleitzahl'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie die Postleitzahl der Stelle ein.'); ?></div>
	    		<div class="item"><?=Html::textInput('postcode', $jobModel->postcode) ?></div>

	    		<div class="title"><?php echo Yii::t('app', 'Branchen'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie den Branch der Stelle ein.'); ?></div>
	    		<div class="item"><?=Html::dropDownList('branch', $jobModel->branch, $branchs) ?></div>

	    		<div class="title"><?php echo Yii::t('app', 'Aufgaben'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie den Aufgaben der Stelle ein.'); ?></div>
	    		<div class="item">
    	    		<div class="">
    	    			<input class="add-text-item task-text-item" >
    	    			<button type="button" class="addbutton" ng-click="addTask()"><b style="font-size: 18px">+</b>  <?php echo Yii::t('app', 'hinzufügen'); ?></button>
    	    		</div>
	    			<div class="task-item-container">
	    				<div ng-repeat="task in selectedTaskList" class="task-item">{{task}} <i ng-click="deleteTask(task)" class="material-icons">delete</i></div>
	    			</div>
	    		</div>

	    		<div class="title"><?php echo Yii::t('app', 'Qualifikationen'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Geben Sie den Qualifikationen der Stelle ein.'); ?></div>
	    		<div class="item">
    	    		<div class="">
    	    			<input class="add-text-item skill-text-item" >
    	    			<button type="button" class="addbutton" ng-click="addSkill()"><b style="font-size: 18px">+</b>  <?php echo Yii::t('app', 'hinzufügen'); ?></button>
    	    		</div>
	    			<div class="task-item-container">
	    				<div ng-repeat="skill in selectedSkillList" class="task-item">{{skill}} <i ng-click="deleteSkill(skill)" class="material-icons">delete</i></div>
	    			</div>
	    		</div>

	    		

	    	</div>
	    </div>
    	
	    <div class="job-adv-wizard-item wizard-item2">
	    	<div class="item-title"><?php echo Yii::t('app', 'Raumen Bedingungen'); ?></div>
	    	<div class="content">
	    		<div class="title"><?php echo Yii::t('app', 'Aktuelle Vakanzen'); ?>:*</div>
	    		<div class="item">
	    		<?php foreach($vacancies as $id => $title) {?>
	    			<label class="vakancy-title"><?php echo $title; ?></label><input ng-model="selectedVacance" class="vakancy-item" type="radio" value="<?php echo $id; ?>" name ="vacancy" />
	    		<?php } ?>
	    			<label class="vakancy-title">Sonstige</label><input class="vakancy-item" ng-click="otherVacancySelected()" ng-model="selectedVacance" type="radio" value="0" name ="vacancy" />
	    			<input ng-show="selectedVacance == 0" class="other-vacancy" >
	    		</div>
	    		
				<div class="h-divider"></div>
				
	    		<div class="title"><?php echo Yii::t('app', 'Job-Beginn und Dauer'); ?>:*</div>
	    		<div class="desc"><?php echo Yii::t('app', 'Bitte geben Sie den Job-Beginn und die geplante Dauer an.'); ?></div>
	    		<div class="" style="padding-left: 30px; padding-top: 5px; margin-bottom: 10px;">
	    			<div>
		    			<label style="width:50px;"><?php echo Yii::t('app', 'Start'); ?></label>&nbsp;<?=Html::dropDownList('jobstart_month', $startmonth, $months) ?>
		    			&nbsp;&nbsp;<?=Html::dropDownList('jobstart_year', $startyear, $years) ?><br>	    			
	    			</div>
	    			<div style="margin-top: 6px;">
		    			<label style="width:50px; "><?php echo Yii::t('app', 'Dauer'); ?></label>&nbsp;
		    			<?=Html::textInput('jobduration', $jobModel->duration , ['type' => 'number' , 'style'=>'width:100px; height: 26px;']) ?> &nbsp;<label style="width:120px;"><?php echo Yii::t('app', 'Monate'); ?></label>
		    			<?=Html::checkbox('extends', $jobModel->extends == 1) ?> &nbsp;<?php echo Yii::t('app', 'Verlängerung möglich'); ?>
	    			</div>
	    		</div>

				<div class="h-divider"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Arbeitszeitmodel'); ?>:*</div>
	    		<div class="desc" style="margin-bottom: 10px;"><?php echo Yii::t('app', 'Bitte wählen Sie den Arbeitszeitmodel der Stelle aus'); ?></div>
	    		<div class="item" style="margin-bottom: 10px;">
	    			<?=Html::dropDownList('worktype', $jobModel->worktype, BrainStaticList::workTypeList()) ?>
	    		</div>

				<div class="h-divider"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Gültigkeit'); ?>:*</div>
	    		<div class="desc" style="margin-bottom: 10px;"><?php echo Yii::t('app', 'Im folgenden können Sie ein Gültigkeitsdatum eintragen. Nach diesem Datum wird Ihr Stellenanzeige nicht mehr im Verzeichnis gelistet'); ?></div>
	    		<div class="item" style="padding-bottom: 10px;">
	    			<label style="width:100px; "><?php echo Yii::t('app', 'Gültigkeit: '); ?></label>&nbsp;
	    			<?=Html::textInput('expiredate', $jobModel->expiredate, ['style'=>'width:120px; height: 26px;', 'class' => 'calender-icon']) ?>
	    		</div>

				<div class="h-divider"></div>

	    		<div class="title"><?php echo Yii::t('app', 'Notiz'); ?>:</div>
	    		<div class="desc" style="margin-bottom: 10px;"><?php echo Yii::t('app', 'Bitte geben Sie den Notiz. der Stelle an.'); ?></div>
	    		<div class="item">
	    			<?=Html::textarea('comments', $jobModel->comments, ['style'=>'width:90%; height: 150px;']) ?>
	    		</div>
	    		

	    	</div>
	    </div>
    	
    	<div class="nav-button-set">
    		<div class="button cancel"><?php echo Yii::t('app', 'abbrechen'); ?></div>
    		<div class="button prev"><?php echo Yii::t('app', 'zurück'); ?></div>
    		<div class="button next"><?php echo Yii::t('app', 'weiter'); ?></div>
    		<div class="buttonapply "><?php echo Yii::t('app', 'Stellenanzeige speichern und veröffentlichen'); ?></div>
    		<?php if($jobModel->isNewRecord) {?>
	    	<div class="apply-condition">
    			<input class="checkboxstyleone" type="checkbox" id="checkcondition" name="checkcondition" />
			    <label for="reachemail"><?php echo Yii::t('app', 'Ja, ich habe die <a href="#">Nutzungsbedingungen</a> gelesen und stimme diesen zu. Die <a href="#">Datenschutzerklärung</a> habe ich zur Kenntnis genommen.'); ?></label>
	    		<span class="checkone"><span class="inside"></span></span>

	    	</div>
	    	<?php } ?>
    	</div>
    </div>
<?php ActiveForm::end() ?>
</div>

<script type="text/javascript">
var title_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Title für Ihre Anzeigeausschreibung beim ersten Schritt ein!'); ?>";
var country_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie das Land der Stelle beim ersten Schritt aus!'); ?>";
var city_msg = "<?php echo Yii::t('app', 'Geben Sie den Standort der Stelle beim ersten Schritt ein!'); ?>";
var postcode_msg = "<?php echo Yii::t('app', 'Geben Sie die Postleitzahl der Stelle beim ersten Schritt ein!'); ?>";
var comment_msg = "<?php echo Yii::t('app', 'Beschreiben Sire Ihre Stelle beim ersten Schritt nun möglichst detailliert!'); ?>";
var vacancy_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie die Vakanz der Stelle beim zweiten Schritt aus!'); ?>";
var worktype_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie den Arbeitszeitmodel der Stelle aus!'); ?>";
var jobdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Job-Beginn und die geplante Dauer beim zweiten Schritt an!'); ?>";
var expire_msg = "<?php echo Yii::t('app', 'Bitte geben Sie die Gültigkeit der Stellenanzeige beim zweiten Schritt an!'); ?>";
var condition_msg = "<?php echo Yii::t('app', 'Bitte stimmen Sie die Nutzungsbedingungen und die Datenschutzerklärung!'); ?>";
var skill_exists_msg = '<?php echo Yii::t('app', 'Das Schlagwort "%" existiert in der liste!'); ?>';

var advlisturl = "<?php echo YII::getAlias('@web')?>/company/dashboard/jobs";

var allskils = new Array();
var skilltypelist = new Array();
<?php foreach ($skills as $id => $skill){?>
allskils.push("<?php echo $skill;?>");
<?php } ?>
  
</script>

