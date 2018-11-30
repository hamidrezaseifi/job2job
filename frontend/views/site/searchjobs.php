<?php
/* @var $this yii\web\View */
/* @var $text string */
/* @var $ort string */
/* @var $jobtype Integer */
/* @var $worktype Integer */
/* @var $vacancy string */
/* @var $ort string */
/* @var $jobitems string */
/* @var $places array */
/* @var $advanced boolean */
/* @var $worktypes array */
/* @var $jobypes array */
/* @var $vacancies array */
/* @var $skills array */
/* @var $itemstitle string */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->registerCssFile("@web/web/css/jobadv.css", [], 'css-jobadv');
$this->registerJsFile("@web/web/js/jobsearch.js", [], 'js-jobsearch');

?>
<?=Html::hiddenInput('lastqs', $_SERVER["QUERY_STRING"], ['id' => 'lastquery']) ?>


<div class="index-part-1" style="padding-top: 5px !important;" ng-controller="JobSearchController">
    <div class="jobsearch-top-title">
    	<div class="index-jobsearch-title1"><?php echo Yii::t('app', 'Wir bringen Menschen passgenau zusammen - fachkompetent und zielsicher.');?></div>
    	<div class="index-jobsearch-title2 j2jgreentext"><?php echo Yii::t('app', 'Einfach registrieren, Suchmaschine anklicken und Personal oder Job finden!');?></div>
    	<div class="index-jobsearch-title"><?php echo Yii::t('app', 'Jetzt Top Jobs in Ihrer Nähe finden');?></div>
    </div>

	<div class="index-jobsearch-box">
		<?php ActiveForm::begin(['action' => Yii::getAlias('@web') . '/site/searchjobitems', 'id' => 'searchform', 'method' => 'get'])?>
		<div class="index-jobsearch-box-in" style="height:<?php echo $advanced ? '180': '100'; ?>px;">
			<input type="text" id="searchtext" name="st" value="<?php echo $text;?>" placeholder="<?php echo Yii::t('app', 'Beruf, Job, Qualifikation'); ?>" />
			<input type="text" id="searchort" name="so" value="<?php echo $ort; ?>" placeholder="<?php echo Yii::t('app', 'Ort, PLZ'); ?>" />
			<input type="button" id="searchbutton" ng-click="startSearch()" style="width:200px; margin-right: 0 !important;" value="<?php echo Yii::t('app', 'Suche starten'); ?>" />
			<div id="advancedbutton" title="Erweiterte Suche" tools="Erweiterte Suche" data-adv="<?php echo $advanced ? 'adv': 'noadv'; ?>" data-advtitle="<?php echo Yii::t('app', 'Erweitert'); ?>" data-noadvtitle="<?php echo Yii::t('app', 'Einfach'); ?>"  ng-click="toggleAdvanced()"><?php echo $advanced ? Yii::t('app', 'Einfach'): Yii::t('app', 'Erweitert'); ?></div>
			<?=Html::dropDownList('vk', $vacancy, $vacancies, ['style' => 'margin-left: 25px;', 'class' =>'clear adv']) ?>
			<?=Html::dropDownList('wt', $worktype, $worktypes, ['class' =>'adv']) ?>
			<?=Html::dropDownList('jt', $jobtype, $jobypes, ['class' =>'adv']) ?>
			<?=Html::hiddenInput("dosearch", 1) ?>
		</div>
		<?php ActiveForm::end()?>
	</div>
	
	<div class="index-part-2 jobsearch-top-items-container" id="index-part-2" style="margin-top: 30px !important;" ng-show="showItemsContainer">
		<div class="index-part-2-in" style="margin-top: 0 !important;">
				
			<div class="jobsearch-top-items-title" style="margin-top: 20px;font-size: 22px;font-weight: bold; margin-left: 70px;" ng-bind-html="itemsTitle"></div>
						
			<a ng-repeat="x in itemsList" href="<?=Yii::getAlias('@web') ?>/site/jobview?id={{x.id}}">
        		<div class="index-part-2-job_item" data-index=" {{x.index}}"> {{x.title}} </div>
        		<div class="index-part-2-ort_item"> {{x.country + " / " + x.city}} </div>
    		</a>
			
			<div style="height: 50px; clear: both;" id="afterlastjobpos"></div>
			
			<div class="index-part-2-title" id="nextjoblinkcontainer" ng-show="showNextItems">
				<a href="#" onclick="nextAdvJob(); return false;"><?php echo Yii::t('app', 'weitere ...'); ?></a> 
				<img src="<?php echo Yii::getAlias('@web')?>/web/images//loading.gif" width="70" id="nextjobloading" />
			</div>
			
					
		</div>
		<div class="clear"></div>
	</div>
	<div ng-show="loadingSearchShow" class="fade-in-out loading-full"></div>
		
</div>

<script type="text/javascript">

var nextjoburl = "<?php echo Yii::getAlias('@web')?>/site/nextjob";
var part_2_showed = false;
var nextjobcount = 5;


var places = new Array();
<?php foreach ($places as $place){?>
places.push("<?php echo $place;?>");
<?php }?>

var skills = new Array();
<?php foreach ($skills as $skill){?>
skills.push("<?php echo $skill;?>");
<?php }?>

$(document).ready(function(){


});

</script>