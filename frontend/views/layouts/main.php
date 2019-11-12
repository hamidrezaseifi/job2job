<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\lib\LanguagesBase;
use yii\widgets\ActiveForm;
use frontend\controllers\CandidateController;
use frontend\controllers\CompanyController;
use common\lib\BranchBase;

AppAsset::register ( $this );

$photopath = false;

$user = Yii::$app->user;
$identity = Yii::$app->user->identity;
$isCompany = false;
$isCandidate = false;

if (! $user->isGuest) {
	$photopath = false;
	if ($identity->isCandidate ()) {
		$photopath = CandidateController::personal_photo ( true );
		$isCandidate = true;
	}

	if ($identity->isCompany ()) {
		$photopath = CompanyController::company_logo ( true );
		$isCompany = true;
	}

	if ($photopath) {
		$photopath = $photopath && is_string ( $photopath ) ? $photopath : Yii::getAlias ( '@web' ) . '/web/images/person2.png';
	}
}
if (! $photopath) {
	$photopath = Yii::getAlias ( '@web' ) . '/web/images/person2.png';
}

?>
<?php

$this->beginPage ()?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>" ng-app="brainApp">
<head>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?=Html::csrfMetaTags ()?>
    <title><?=Html::encode ( Yii::$app->params ['sitetitle'] )?></title>
    <?php $this->head ()?>
    <link rel="icon" type="image/png" href="<?=Yii::getAlias ( '@web/web/images' )?>/site-icon.jpg">
    <link rel="stylesheet" href="<?=Yii::getAlias ( '@web' )?>/web/css/jquery.lightbox.min.css">

    <script src="<?=Yii::getAlias ( '@web' )?>/web/js/mainlayout.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias ( '@web/web' )?>/js/isInViewport.min.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias ( '@web/web' )?>/js/utils.js"></script>

    <link rel="stylesheet" id="ubermenu-css" href="<?=Yii::getAlias ( '@web' )?>/web/css/ubermenu.css" type="text/css" media="all">


</head>
<body ng-controller="BodyController">

<?php $this->beginBody ()?>



	<div class="job2jobheader">
		<div class="top-header">
			<div class="topheader-center">
                <?php if (! $user->isGuest) { ?>
                <p><a href="<?=Yii::getAlias ( '@web' )?>/site/logout"><mat-icon class="material-icons">exit_to_app</mat-icon> abmelden</a></p>
                <?php } ?>
    			<p><a href="tel:<?php echo Yii::$app->params ["job2jobtel"] ["tel"]?>"><mat-icon class="material-icons">phone</mat-icon> 
    			<?php echo Yii::$app->params ["job2jobtel"] ["label"]?></a></p>
                <p><a href="<?=Yii::getAlias ( '@web' )?>/site/contact"><mat-icon class="material-icons">contact_mail</mat-icon> Kontakt</a></p>
                <?php if (! $user->isGuest) { ?>
                <p><a class="myprofile" href="<?=Yii::getAlias ( '@web' ) . ($identity->isCandidate () ? '/candidate' : '/company')?>/dashboard/myprofile"><mat-icon class="material-icons">person</mat-icon> Mein Profil</a></p>
                <?php } else { ?>
                
                <p><a class="login" id="loginlink" href="<?=Yii::getAlias ( '@web' )?>/site/login" ><mat-icon class="material-icons">lock</mat-icon> Login</a></p>
                
                <?php } ?>

			</div>
		</div>
		<header id="masthead" class="site-header" role="banner">
			<div class="content-center">
				<a class="logo" href="<?=Yii::getAlias ( '@web' )?>/"><img src="<?=Yii::getAlias ( '@web' )?>/web/images/logo.png"></a>
				<div class="right-header">
					<div class="open-menu-responsive toggle-button1" ng-click="toggleMobileMenu()">
						<div class="stripes"><span></span><span></span><span></span></div>
					</div>

                    <nav id="ubermenu-main-2" class="ubermenu ubermenu-main ubermenu-menu-2 ubermenu-responsive-collapse ubermenu-horizontal ubermenu-transition-slide ubermenu-trigger-hover_intent ubermenu-skin-none  ubermenu-bar-align-full ubermenu-items-align-left ubermenu-bound ubermenu-sub-indicators ubermenu-retractors-responsive ubermenu-notouch">
                    	<ul id="ubermenu-nav-main-2" class="ubermenu-nav">
                    		<?php if ($user->isGuest || $identity->isCandidate ()) { ?>
                    		<li class="ubermenu-item  ubermenu-current-menu-item  ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega">
                    			<a class="ubermenu-target " tabindex="0" href="<?=Yii::getAlias ( '@web' )?>/site/candidate">
                    				<span class="ubermenu-target-title ubermenu-target-text">FÜR BEWERBER</span>
                    			</a>
                    			<ul class="ubermenu-submenu ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-full_width ubermenu-submenu-content-align-center">
                    				<li class=" ubermenu-autocolumn ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column">
                    					<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    						<li class=" ubercolumn-specialclass ubermenu-item   ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    							<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    								<li class="title-submenuuber no-hover ubermenu-item ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ">
                    										<span class="ubermenu-target-title ubermenu-target-text">BRANCHEN</span>
                    									</a>
                    								</li>
                    								<li ng-repeat="branch in branchs " class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/branchview/candidate/{{branch.shortcut}}">
                    										<span class="ubermenu-target-title ubermenu-target-text">{{branch.label}}</span>
                    									</a>
                    								</li>
                    							</ul>
                    						</li>
                    						<li class=" ubercolumn-specialclass ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    							<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/whyjob2job">
                    										<span class="ubermenu-target-title ubermenu-target-text">WARUM JOB2JOB?</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/freelance">
                    										<span class="ubermenu-target-title ubermenu-target-text">ÜBER ZEITARBEIT</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/carrier">
                    										<span class="ubermenu-target-title ubermenu-target-text">KARRIERE</span>
                    									</a>
                    								</li>
                    							</ul>
                    						</li>
                    					</ul>
                    				</li>
                    			</ul>
                    		</li>
                    		<?php if($isCandidate){?>
                    		<li class="ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega">
                    			<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/myprofile" tabindex="0">
                    				<span class="ubermenu-target-title ubermenu-target-text">MEIN PROFIL</span>
                    			</a>
                    			<ul class="ubermenu-submenu ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-full_width ubermenu-submenu-content-align-center">
                    				<li class=" ubermenu-autocolumn  ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column">
                    					<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    						<li class="ubercolumn-specialclass ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    							<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard" >
                    										<span class="ubermenu-target-title ubermenu-target-text">DASHBOARD</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/myprofile" >
                    										<span class="ubermenu-target-title ubermenu-target-text">MEIN PROFIL</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/markedjob" >
                    										<span class="ubermenu-target-title ubermenu-target-text">GEMERKTE ANZEIGEN</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/applyjob" >
                    										<span class="ubermenu-target-title ubermenu-target-text">BEWORBENE STELLENANZEIGEN</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/messages" >
                    										<span class="ubermenu-target-title ubermenu-target-text">NACHRICHTEN</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/logout" >
                    										<span class="ubermenu-target-title ubermenu-target-text">ABMELDEN</span>
                    									</a>
                    								</li>
                    							</ul>
                    						</li>
                    					</ul>
                    				</li>
                    			</ul>
                    		</li>
                    		
                    		<?php } }
							if ($user->isGuest || $identity->isCompany ()) { ?>
                    		<li class="ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega">
                    			<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/company" tabindex="0">
                    				<span class="ubermenu-target-title ubermenu-target-text">FÜR UNTERNEHMER</span>
                    			</a>
                    			<ul class="ubermenu-submenu ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-full_width ubermenu-submenu-content-align-center">
                    				<li class=" ubermenu-autocolumn  ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column">
                    					<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    						<li class="ubercolumn-specialclass ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    							<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    								<li class="title-submenuuber no-hover ubermenu-item ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " >
                    										<span class="ubermenu-target-title ubermenu-target-text">BRANCHEN</span>
                    									</a>
                    								</li>
                    								<li ng-repeat="branch in branchs" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/branchview/company/{{branch.shortcut}}">
                    										<span class="ubermenu-target-title ubermenu-target-text">{{branch.label}}</span>
                    									</a>
                    								</li>
                    							</ul>
                    						</li>
                    						<li class=" ubercolumn-specialclass ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    							<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    								<li class="title-submenuuber no-hover ubermenu-item  ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " >
                    										<span class="ubermenu-target-title ubermenu-target-text">GESCHÄFTSMODELLE</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/temporarywork">
                    										<span class="ubermenu-target-title ubermenu-target-text">ARBEITNEHMERÜBERLASSUNG</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/personaladoption">
                    										<span class="ubermenu-target-title ubermenu-target-text">PERSONALÜBERNAHME</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/personalrecruitment">
                    										<span class="ubermenu-target-title ubermenu-target-text">PERSONALREKRUTIERUNG</span>
                    									</a>
                    								</li>
                     							</ul>
                    						</li>
                    					</ul>
                    				</li>
                    				<li class=" ubermenu-autocolumn  ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column">
                    				<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    					<li class=" ubercolumn-image ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    						<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    							<li class="no-href-link no-hover ubermenu-item ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    								<br>
                    							</li>
                    						</ul>
                    					</li>
                    				</ul>
                    			</li>
                    		</ul>
                    		</li>
                    		<?php if($isCompany){?>
                    		<li class="ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega">
                    			<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/company/dashboard/myprofile" tabindex="0">
                    				<span class="ubermenu-target-title ubermenu-target-text">MEIN PROFIL</span>
                    			</a>
                    			<ul class="ubermenu-submenu ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-full_width ubermenu-submenu-content-align-center">
                    				<li class=" ubermenu-autocolumn  ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column">
                    					<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    						<li class="ubercolumn-specialclass ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    							<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/company/dashboard" >
                    										<span class="ubermenu-target-title ubermenu-target-text">DASHBOARD</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/company/dashboard/myprofile" >
                    										<span class="ubermenu-target-title ubermenu-target-text">MEIN PROFIL</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/company/dashboard/jobs" >
                    										<span class="ubermenu-target-title ubermenu-target-text">JOB ANZEIGEN</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/company/dashboard/messages" >
                    										<span class="ubermenu-target-title ubermenu-target-text">NACHRICHTEN</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/logout" >
                    										<span class="ubermenu-target-title ubermenu-target-text">ABMELDEN</span>
                    									</a>
                    								</li>
                    							</ul>
                    						</li>
                    					</ul>
                    				</li>
                    			</ul>
                    		</li>
                     		
                    		<?php } } ?>

                    	<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page  ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega">
                    		<a href="<?=Yii::getAlias ( '@web' )?>/site/whoweare" class="ubermenu-target " tabindex="0">
                    			<span class="ubermenu-target-title ubermenu-target-text">Über Uns</span>
                    		</a>
                    		<ul class="ubermenu-submenu ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-full_width ubermenu-submenu-content-align-center">
                    			<li class=" ubermenu-autocolumn ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column">
                    				<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    					<li class=" ubercolumn-specialclass ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    						<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    							<li class="title-submenuuber no-hover ubermenu-item ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    								<span class="ubermenu-target-title ubermenu-target-text">ÜBER UNS</span>
                    							</li>
                    							<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal ubermenu-column ubermenu-column-auto">
                    								<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/whatwedo">
                    									<span class="ubermenu-target-title ubermenu-target-text">Was wir machen</span>
                    								</a>
                    							</li>
                    							<li class="no-hover ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal ubermenu-column ubermenu-column-auto">
                    								<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/certificates">
                    									<span class="ubermenu-target-title ubermenu-target-text">Zertifikate</span>
                    								</a>
                    							</li>
                    							<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    								<a class="ubermenu-target " href="<?=Yii::getAlias ( '@web' )?>/site/partnerassociation">
                    									<span class="ubermenu-target-title ubermenu-target-text">Partner & Verbände</span>
                    								</a>
                    							</li>
                    						</ul>
                    					</li>
                    				</ul>
                    			</li>
                    			<li class=" ubermenu-autocolumn ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column">
                    				<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    					<li class=" ubercolumn-image ubermenu-item ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column">
                    						<ul class="ubermenu-submenu ubermenu-submenu-type-stack">
                    							<li class="no-href-link no-hover ubermenu-item ubermenu-item-auto ubermenu-item-normal  ubermenu-column ubermenu-column-auto">
                    								<br>
                    							</li>
                    						</ul>
                    					</li>
                    				</ul>
                    			</li>
                    		</ul>
                    	</li>

					</ul>
				</nav>


				<div class="button-header" style="width: 170px;">
					<p>
						<?php if ($user->isGuest || $identity->isCandidate ()) { ?><a href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs">JOB SUCHEN</a><?php } ?>
					</p>
				</div>
				<a id="mobileheaderphone" href="tel:+49 89 599 182 70">
					<i class="fa fa-phone" aria-hidden="true"></i>
				</a>

				</div>
			</div>
		</header>

	</div>

	<md-sidenav class="md-sidenav-left" md-component-id="leftMenu" >

    	<div class="all-menu-mobile1">
    	 	<div class="title-menu-mobile" ng-click="closeMobileMenu()"></div>
    	 	<div class="mobilejobsearch">
    	 		<p><?php if ($user->isGuest || $identity->isCandidate ()) { ?><a href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs">JOB SUCHEN</a><?php } ?></p>
    	 	</div>
    	 	<?php if ($user->isGuest) { ?>
    	 	<div class="mobilelogin">
    	 		<p><a href="<?=Yii::getAlias ( '@web' )?>/site/login">Anmelden</a></p>
    	 	</div>
    	 	<?php }  else { ?>
    	 	<div class="mobilelogin">
    	 		<p><a href="<?=Yii::getAlias ( '@web' )?>/site/logout">Abmelden</a></p>
    	 	</div>
    	 	<?php } ?>
    		<div class="menu-responsive-menu-container"><ul id="menu-responsive-menu" class="menu">
    			<li><a href="<?=Yii::getAlias ( '@web' )?>/">STARTSEITE</a></li>
    			<?php if ($user->isGuest || $identity->isCandidate ()) { ?>
                <li><a href="<?=Yii::getAlias ( '@web' )?>/site/candidate">FÜR BEWERBER</a><span class="opensubmenumob" ng-click="toggleSubMenuVisible('candidate')"></span><span class="clear"></span>
                <ul ng-show="submenuVisible['candidate']">
                	<li><a class="title" >BRANCHEN</a></li>
					
                	<li  ng-repeat="branch in branchs "><a href="<?=Yii::getAlias ( '@web' )?>/site/branchview/candidate/{{branch.shortcut}}">{{branch.label}}</a></li>

	               	<li><a class="sub title" >ALLGEMEIN</a></li>

                	<li><a href="<?=Yii::getAlias ( '@web' )?>/site/whyjob2job">WARUM JOB2JOB?</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/site/freelance">ÜBER ZEITARBEIT</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/site/carrier">KARRIERE</a></li>
                </ul>
                </li>
                <?php if($isCandidate){?>
                <li><a href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/myprofile">MEIN PROFIL</a><span class="opensubmenumob" ng-click="toggleSubMenuVisible('candidateprofile')"></span><span class="clear"></span>
                <ul ng-show="submenuVisible['candidateprofile']">
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard">Mein DASHBOARD</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/myprofile">MEIN PROFIL</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/markedjob">GEMERKTE ANZEIGEN</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/applyjob">BEWORBENE STELLENANZEIGEN</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/candidate/dashboard/messages">NACHRICHTEN</a></li>
                </ul>
                </li>
                <?php } } ?>
                <?php if ($user->isGuest || $identity->isCompany ()) { ?>
                <li><a href="<?=Yii::getAlias ( '@web' )?>/site/company">FÜR UNTERNEHMER</a><span class="opensubmenumob" ng-click="toggleSubMenuVisible('company')"></span><span class="clear"></span>
                <ul ng-show="submenuVisible['company']">
                	<li><a class="title" >BRANCHEN</a></li>

                	<li  ng-repeat="branch in branchs " class=" "><a href="<?=Yii::getAlias ( '@web' )?>/site/branchview/company/{{branch.shortcut}}">{{branch.label}}</a></li>

                	<li><a class="title" >GESCHÄFTSMODELLE</a></li>

					<li><a href="<?=Yii::getAlias ( '@web' )?>/site/temporarywork">ARBEITNEHMERÜBERLASSUNG</a></li>
					<li><a href="<?=Yii::getAlias ( '@web' )?>/site/personaladoption">PERSONALÜBERNAHME</a></li>
					<li><a href="<?=Yii::getAlias ( '@web' )?>/site/personalrecruitment">PERSONALREKRUTIERUNG</a></li>

                </ul>
                </li>
                <?php if($isCompany){?>
                <li><a href="<?=Yii::getAlias ( '@web' )?>/company/dashboard/myprofile">MEIN PROFIL</a><span class="opensubmenumob" ng-click="toggleSubMenuVisible('companyprofile')"></span><span class="clear"></span>
                <ul ng-show="submenuVisible['companyprofile']">
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/company/dashboard">Mein DASHBOARD</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/company/dashboard/myprofile">MEIN PROFIL</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/company/dashboard/jobs">JOB ANZEIGEN</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/company/dashboard/messages">NACHRICHTEN</a></li>
                </ul>
                </li>
                <?php } } ?>
                <li><a href="<?=Yii::getAlias ( '@web' )?>/site/whoweare" >Über Uns</a><span class="opensubmenumob" ng-click="toggleSubMenuVisible('about')"></span><span class="clear"></span>
                <ul ng-show="submenuVisible['about']">
                	<li><a class="title">ÜBER UNS</a></li>

                	<li><a href="<?=Yii::getAlias ( '@web' )?>/site/whatwedo">Was wir machen</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/site/certificates">Zertifikate</a></li>
                	<li><a href="<?=Yii::getAlias ( '@web' )?>/site/partnerassociation">Partner & Verbände</a></li>
                	
                </ul>
                </li>
                <li><a href="<?=Yii::getAlias ( '@web' )?>/site/contact">Kontakt</a></li>
                </ul>
            </div>
        </div>

    </md-sidenav>

<div class="main-content">
<?=$content?>
</div>

<?php if ($user->isGuest && false) { ?>
<div class="mainlogin">
	<div class="content-center">
		<h3 class="body-login-title"><strong>BEI MEIN JOB2JOB ANMELDEN</strong></h3>

		<?php $form = ActiveForm::begin ( [
			'id' => 'loginmodule',
			'action' => Yii::getAlias ( '@web' ) . '/site/login'
	   ] ); ?>
			<div class="response-errors">
				<div class="errormsg">

				Die eingegebene E-mail Adresse und/oder das Passwort ist falsch. Bitte versuchen Sie es erneut!
								</div>
				<div class="donemsg">

				Erfolgreich eingeloggt!
								</div>
				<div class="errorpassword">

				Passwörter stimmen nicht überein!
								</div>
			</div>

            <input type="email" id="emailaddress" name="LoginForm[username]" title="Bitte geben Sie ihre Vorname an!
            Vorname darf nur Buchstaben und mindestens 4 Buchstaben enthalten . Z.B. John" placeholder="E-Mail">

			<input id="pass1" type="password" name="LoginForm[password]" class="requiredfield" placeholder="Passwort">
			<input type="submit" value="go" style="display: none;">
			<div class="button-form-login button-form-login-ajax" ng-click="submitLogin()">ANMELDEN</div>
			<a href="<?=Yii::getAlias ( '@web' )?>/site/register">Registrieren?</a>
		<?php

	ActiveForm::end ()?>
	</div>
</div>
<?php } ?>
<div class="bottom-footer no-print">
	<div class="footer-child padding-rl-50px">
        <div style="font-size:12px; line-height: 20px;"><b>Job2Job GmbH</b></div>
        Hefehof 20<br>
        31785 Hameln<br>
		<a href="tel:+4951515569430">+49 5151/55694-30</a><br>
	</div>
	<div class="footer-child padding-rl-50px">
        <div style="font-size:12px; line-height: 20px;"><b>Job2Job GmbH</b></div>
        Lindenstraße 5 (am ZOB)<br>
        32423 Minden<br>
		<a href="tel:+4957140493170">+49 571/40493170</a><br>
	</div>
	<div class="footer-child">
        <div style="font-size:16px; text-align: center; margin-bottom: 10px;" class="center">FOLGE UNS</div>
        <div class="center-links-footer">
			<a href="https://www.facebook.com/Job2Job-364898756919464/" target="_blank">
				<span class="sprite facebook footer-social"></span>
			</a>
			<a href="https://www.xing.com/profile/Madeleine_Mohr2/cv" target="_blank">
				<span class="sprite k footer-social"></span>
			</a>
		</div>
	</div>
	<div class="footer-child padding-rl-50px">
        <div style="font-size:12px; line-height: 20px;"><b>Job2Job GmbH Rechte</b></div>
        <a class="footer-link" href="<?=Yii::getAlias ( '@web' )?>/site/impressum">Impressum</a> <br>
        <a class="footer-link" href="<?=Yii::getAlias ( '@web' )?>/site/privacypolicy">Datenschutz & Bestimmungen</a> <br>
        <a class="footer-link" href="<?=Yii::getAlias ( '@web' )?>/site/rights">Ihre Rechte</a> <br>
	</div>
	<div class="footer-child footer-last">
        <div style="font-size:12px; line-height: 20px; text-align: center; margin-bottom: 10px;">Sie haben Fragen?</div>
        <div class="footer-contact button-footer">
			<a href="<?=Yii::getAlias ( '@web' )?>/site/contact/" class="contact-button">KONTAKTIEREN</a>
		</div>
	</div>
</div>

<div class="cookieusage" ng-if="acceptUsageCookieVisible()">
	<div class="cookie-text"><b>Diese Webseite verwendet Cookies</b></div>
	<div class="cookie-button">
		<p><a ng-click="acceptUsageCookie()">Einverstanden</a></p>
	</div>
</div>

<?php

$this->endBody ()?>
</body>
<script type="text/javascript">
var pageBranches = <?php

print (json_encode ( BranchBase::allActive () )) ;

?>;
</script>
</html>
<?php

$this->endPage ()?>
