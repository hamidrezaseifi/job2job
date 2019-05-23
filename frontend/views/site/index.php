<?php
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $jobitems string */
/* @var $places array */
/* @var $recommendations array */
/* @var $jobModels array */

$this->title = yii::$app->params ['sitetitle'] . ' | ' . Yii::t ( 'app', 'Home Page' );

$this->registerJsFile ( "@web/web/js/index.js", [ ], 'js-index' );
$this->registerJsFile ( "@web/web/js/segments.js", [ ], 'js-segments' );
$this->registerJsFile ( "@web/web/js/recommandation-slider.js", [ ], 'js-recommandation-slider' );
$this->registerCssFile ( "@web/web/css/segments.css", [ ], 'css-segment' );
$this->registerCssFile ( "@web/web/css/index.css", [ ], 'css-index' );

$user = Yii::$app->user;
$identity = $user->identity;
$isCompany = $identity ? $identity->isCompany() : false;

?>

<div ng-controller="IndexController">
	<div class="home home-main-content">
        <div class="home-box-1 top-section top-section-with-boxes" >
        	<?php echo $this->render('topbanner', ['showSearch' => ($user->isGuest || !$isCompany), 'showEmployeeFinder' => (!$user->isGuest && $isCompany), 'firstPage' => true, ]);?>
        </div>
	</div>

	<div class="home home-teaser">
		<div class="teaser-box-container">
    		<div class="teaser-box">
    			<div class="teaser-heaser">FÜR UNTERNEHMEN</div>
    			<div class="teaser-text" style="height: 140px;">Die gründliche Mitarbeitersuche bleibt erfolglos? Leider kein Einzelfall. Der „War of Talents“ wurde selten so hart geführt, wie heute. Gut, dass Sie mit Job2Job einen erfahrenen Verbündeten an Ihrer Seite wissen.</div>
    			<div class="teaser-link-container"><a class="teaser-link" href="<?=Yii::getAlias ( '@web' )?>/site/whyjob2job">Warum-Job2Job? >> </a></div>
    		</div>
		</div>
		
		<div class="teaser-box-container">		
    		<div class="teaser-box">
    			<div class="teaser-heaser">FÜR BEWERBER</div>
    			<div class="teaser-text" style="height: 140px;">Berufliche Perspektive gesucht? Bei Job2Job sind Sie richtig. Wir zeigen Ihnen Wege aus der beruflichen Sackgasse – und vermitteln Ihnen einen Job mit Zukunft. Profitieren Sie von Flexibilität und fairen Löhnen, ohne typischem Bewerbungsstress. </div>
    			<div class="teaser-link-container"><a class="teaser-link" href="<?=Yii::getAlias ( '@web' )?>/site/whyjob2job">Warum-Job2Job? >> </a></div>
    		</div>
		</div>
		
		<div class="teaser-box-container">		
    		<div class="teaser-box">
    			<div class="teaser-heaser">JOBBÖRSE</div>
    			<div class="teaser-text" style="height: 140px;">Vom Gesundheits- und Krankenpfleger über den Maschinenbauingenieur bis hin zur Bürokauffrau. Bei uns finden Sie für (fast) alle Branchen die passenden Stellenangebote. Sei es in Vollzeit, Teilzeit oder für flexible Einsätze.</div>
    			<div class="teaser-link-container"><a class="teaser-link" href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs">Aktuelle Stellenangebote >> </a></div>
    		</div>
		</div>
		<div class="clear"></div>
	</div>

    <?php echo $this->render('recommendation', [
        'recommendations' => $recommendations,]);
    ?>

    <div class="boxes-ref">
		<div class="content-center statistic-anim" >
			<div class="width25" ng-repeat="statistc in numberStatictics">
				<div class="vertical-align">
					<h5 class="count_up finished">{{Math.round(statistc.currentValue)}}</h5><h5><em>{{statistc.label}}</em></h5>
				</div>
			</div>


		</div>



    </div>

    <?php echo $this->render('blue-jobposition-list', [
        'jobModels' => $jobModels,
        'showSearch' => ($user->isGuest || $identity->isCandidate ()), 
        'showMoreFromBranch' => false, 
        'forTitle' => 'FÜR BEWERBER']);
    ?>
    
    
</div>


