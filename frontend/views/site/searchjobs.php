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

// $this->registerCssFile("@web/web/css/jobadv.css", [], 'css-jobadv');
$this->registerJsFile("@web/web/js/searchjob.js", [], 'js-jobsearch');
$this->registerCssFile("@web/web/css/searchjob.css", [], 'css-search-job');

$user = Yii::$app->user;
$identity = $user->identity;
$isCandidate = $identity ? $identity->isCandidate() : false;

?>

<div class="site-search-job" ng-controller="JobSearchController">
	<div class="search-job-title">
		JOB<strong>SUCHE</strong><br>
		<span class="search-job-title2">Geben Sie Ihre Kriterien ein!</span>
	</div>

	<div class="search-job-searchtext">
		<input placeholder="z.B. Deutschland, Pharma, Festanstellung..." ng-model="query['searchText']" value="<?php echo $searchText; ?>" ng-blur="getJobCount()">
		<button ng-click="searchJobs(true)"><i class="material-icons">arrow_forward_ios</i></button>
		<div class="clear"></div>
	</div>

	<div class="search-job-searchlists">
		<div class="dropdown-jobsuche" ng-class="{'active': currentDropdown == 'region'}">
    		<div class="searchlist-item" ng-click="toggleDropdown('region')">
    			<span>REGION</span>
    			<i class="material-icons" ng-if="currentDropdown != 'region'">expand_more</i>
     			<i class="material-icons" ng-if="currentDropdown == 'region'">expand_less</i>
    		</div>	
    		<div class="list-dropdown-jobsuche" ng-show="currentDropdown == 'region'">   
    			<ul>
    				<?php foreach ($regins as $country => $cities){?>
    				<li ng-class="{'active': isRegionSelected('<?php echo $country;?>', 'self')}" ng-click="toggleRegion('<?php echo $country;?>', 'self', $event)"><?php echo $country;?>
    					<ul>
 							<?php foreach ($cities as $city){?>
    						<li ng-class="{'active': isRegionSelected('<?php echo $country;?>', '<?php echo $city;?>')}" ng-click="toggleRegion('<?php echo $country;?>', '<?php echo $city;?>', $event)"><?php echo $city;?></li>
    						<?php } ?>   						
    					</ul>
    				</li>
    				<?php } ?>
    			</ul>
    			<div class="jobsuche-ajax-btn" ng-click="closeDropdown()" ng-if="!hasTags('region')">SCHLIEßEN</div> 			
    			<div class="jobsuche-ajax-btn changed-btn" ng-click="searchJobs(true)" ng-if="hasTags('region')">JOB ANZEIGEN ({{jobsFilterCount}})</div> 			
    		</div>	
		</div>
		
		<div class="dropdown-jobsuche" ng-class="{'active': currentDropdown == 'branch'}">
    		<div class="searchlist-item" ng-click="toggleDropdown('branch')">
    			<span>BRANCHE</span>
    			<i class="material-icons" ng-if="currentDropdown != 'branch'">expand_more</i>
     			<i class="material-icons" ng-if="currentDropdown == 'branch'">expand_less</i>
    		</div>		
    		<div class="list-dropdown-jobsuche branches" ng-show="currentDropdown == 'branch'">    	
    			<ul>  
    				<?php foreach ($branches as $branch){?>
    				<li ng-class="{'active': isBranchSelected(<?php echo $branch->id;?>)}" ng-click="toggleBranch(<?php echo $branch->id;?>, $event)"><?php echo $branch->title;?></li>
    				<?php } ?>
    			</ul>
    			<div class="jobsuche-ajax-btn" ng-click="closeDropdown()" ng-if="!hasTags('branch')">SCHLIEßEN</div> 			
    			<div class="jobsuche-ajax-btn changed-btn" ng-click="searchJobs(true)" ng-if="hasTags('branch')">JOB ANZEIGEN ({{jobsFilterCount}})</div> 			
    		</div>	
		</div>
		
		<div class="dropdown-jobsuche" ng-class="{'active': currentDropdown == 'vacancy'}">
    		<div class="searchlist-item" ng-click="toggleDropdown('vacancy')">
    			<span>VAKANZ</span>
    			<i class="material-icons" ng-if="currentDropdown != 'vacancy'">expand_more</i>
     			<i class="material-icons" ng-if="currentDropdown == 'vacancy'">expand_less</i>
    		</div>		
    		<div class="list-dropdown-jobsuche vacancy" ng-show="currentDropdown == 'vacancy'">   
    			<ul>  
    				<?php foreach ($vacances as $vacancy){?>
    				<li ng-class="{'active': isVacancySelected(<?php echo $vacancy->id;?>)}" ng-click="toggleVacancy(<?php echo $vacancy->id;?>, $event)"><?php echo $vacancy->title;?></li>
    				<?php } ?>
    			</ul>
    			<div class="jobsuche-ajax-btn" ng-click="closeDropdown()" ng-if="!hasTags('vacancy')">SCHLIEßEN</div> 			
    			<div class="jobsuche-ajax-btn changed-btn" ng-click="searchJobs(true)" ng-if="hasTags('vacancy')">JOB ANZEIGEN ({{jobsFilterCount}})</div> 			
    		</div>	
		</div>
		
		<div class="dropdown-jobsuche" ng-class="{'active': currentDropdown == 'skills'}">
    		<div class="searchlist-item" ng-click="toggleDropdown('skills')">
    			<span>SKILLS</span>
    			<i class="material-icons" ng-if="currentDropdown != 'skills'">expand_more</i>
     			<i class="material-icons" ng-if="currentDropdown == 'skills'">expand_less</i>
    		</div>		
    		<div class="list-dropdown-jobsuche skills" ng-show="currentDropdown == 'skills'"> 
    			<ul>  
    				<?php foreach ($skills as $skill){?>
    				<li ng-class="{'active': isSkillSelected('<?php echo $skill;?>')}" ng-click="toggleSkill('<?php echo $skill;?>', $event)"><?php echo $skill;?></li>
    				<?php } ?>
    			</ul>
    			<div class="jobsuche-ajax-btn" ng-click="closeDropdown()" ng-if="!hasTags('skill')">SCHLIEßEN</div> 			
    			<div class="jobsuche-ajax-btn changed-btn" ng-click="searchJobs(true)" ng-if="hasTags('skill')">JOB ANZEIGEN ({{jobsFilterCount}})</div> 			
    		</div>	
		</div>
		
		<div class="clear"></div>
	</div>

	<div class="search-job-selectedtags" ng-show="hasTags()"> 
		<span class="taglabel">Meine Auswahl:</span> 
		<div class="search-job-selectedtags-tags"> </div>
		<div class="clear"></div>
	</div>

    <div class="section-title-founded-jobs">
        <div class="title-founded-jobs">
        	MEINE <strong>SUCHERGEBNISSE</strong><span ng-if="foundJobs.length > 0"><span id="foundedjobsnr">{{foundJobs.length}} von {{jobsSearchCount}}</span>Treffer</span>
        </div>
        
        <div class="div-select-jobsuche">
        	<div class="jqselect-wrap">
        		<div class="jqselect-box">
        			<div class="jqselect" ng-click="showSortList()">{{getSelectedSortOption().label}}</div>
        			<div class="jqoption-box" ng-show="showSOrtList">
        				<div class="jqoption" ng-repeat="item in sortOptionList" ng-click="selectSortOption(item)">{{item.label}}</div>
        			</div>
        		</div>
        	</div>
        </div>	
    </div>

	<div class="box-founded-jobs-container">
		<div ng-repeat="job in foundJobs" class="box-founded-jobs">
			<a href="<?php echo Yii::getAlias("@web");?>/site/jobview/{{job.id}}">
                <div class="highestJobsuche">
                    <div class="title">{{job.title}}</div>
                    <ul>
                		<li ng-repeat="skill in job.skills | limitTo:3" >{{skill}}</li>
                    </ul>
                    		
                    <span class="location">{{job.country}} {{job.city}}</span>
                </div>
			</a>
			<div class="buttons-founded-jobs">
				<a class="button1-founded-jobs" href="<?php echo Yii::getAlias("@web");?>/site/jobview/{{job.id}}">DETAILS</a>
				<a class="button2-founded-jobs" <?php if($isCandidate){?>ng-click="markJob(job.id)"<?php } ?>>MERKEN</a>
			</div>			
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="weitere-laden-btn" ng-if="isMoreJobs" ng-click="loadMoreJob()">Weitere Stellenangebote laden...</div>

    <div class="section-title-founded-jobs down-founded">
        <div class="title-founded-jobs">
        	MEINE <strong>SUCHERGEBNISSE</strong><span ng-if="foundJobs.length > 0"><span id="foundedjobsnr">{{foundJobs.length}} von {{jobsFilterCount}}</span>Treffer</span>
        </div>

    </div>


<div>{{test}}</div>
</div>
<script type="text/javascript">
var jobscounturl = "<?php echo Yii::getAlias("@web") . "/site/jobcount"; ?>";
var jobssearchturl = "<?php echo Yii::getAlias("@web") . "/site/dosearchjobs"; ?>";
var regions = {
		<?php foreach ($regins as $country => $cities){?>
		'<?php echo $country;?>' : { 'self' : false,
			<?php foreach ($cities as $city){?>
			'<?php echo $city;?>' : false,
			<?php } ?>
			}
		<?php } ?>	
	};

var branches = {
		<?php foreach ($branches as $branch){?>
		<?php echo $branch->id;?>:'<?php echo $branch->title;?>',
		<?php } ?>	
	};

var vacancies = {
		<?php foreach ($vacances as $vacancy){?>
		<?php echo $vacancy->id;?>:'<?php echo $vacancy->title;?>',
		<?php } ?>	
	};
var searchText = "<?php echo $searchText; ?>";

</script>
