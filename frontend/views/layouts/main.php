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

if (! $user->isGuest) {
	$photopath = false;
	if ($identity->isCandidate ()) {
		$photopath = CandidateController::personal_photo ( true );
	}

	if ($identity->isCompany ()) {
		$photopath = CompanyController::company_logo ( true );
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
    <script type="text/javascript" src="<?=Yii::getAlias ( '@web/web' )?>/js/datepicker-de.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias ( '@web/web' )?>/js/isInViewport.min.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias ( '@web/web' )?>/js/utils.js"></script>

    <link rel="stylesheet" id="ubermenu-css" href="<?=Yii::getAlias ( '@web' )?>/web/css/ubermenu.css" type="text/css" media="all">



<style id="ubermenu-custom-generated-css">
/** UberMenu Responsive Styles (Breakpoint Setting) **/
@media screen and (min-width: 321px){
  .ubermenu{ display:block !important; } .ubermenu-responsive .ubermenu-item.ubermenu-hide-desktop{ display:none !important; } .ubermenu-responsive.ubermenu-retractors-responsive .ubermenu-retractor-mobile{ display:none; }   /* Force current submenu always open but below others */ .ubermenu-force-current-submenu .ubermenu-item-level-0.ubermenu-current-menu-item > .ubermenu-submenu-drop, .ubermenu-force-current-submenu .ubermenu-item-level-0.ubermenu-current-menu-ancestor > .ubermenu-submenu-drop {     display: block!important;     opacity: 1!important;     visibility: visible!important;     margin: 0!important;     top: auto!important;     height: auto;     z-index:19; }   /* Invert Horizontal menu to make subs go up */ .ubermenu-invert.ubermenu-horizontal .ubermenu-item-level-0 > .ubermenu-submenu-drop{      top:auto;      bottom:100%; } .ubermenu-invert.ubermenu-horizontal.ubermenu-sub-indicators .ubermenu-item-level-0.ubermenu-has-submenu-drop > .ubermenu-target:after{      content:"\f106"; }    /* Invert Vertical menu to make subs go left */ .ubermenu-invert.ubermenu-vertical .ubermenu-item-level-0 > .ubermenu-submenu-drop{   right:100%;   left:auto; } .ubermenu-invert.ubermenu-vertical.ubermenu-sub-indicators .ubermenu-item-level-0.ubermenu-item-has-children > a.ubermenu-target:after{   right:auto;   left:10px;   margin-top:-7px;   content:"\f104"; } .ubermenu-vertical.ubermenu-invert .ubermenu-item > .ubermenu-submenu-drop {   clip: rect(-5000px,5000px,5000px,-5000px); } .ubermenu-responsive-toggle{ display:none; }
}
@media screen and (max-width: 320px){
   .ubermenu-responsive-toggle, .ubermenu-sticky-toggle-wrapper { display: block; }  .ubermenu-responsive{ width:100%; max-height:500px; visibility:visible; overflow:visible;  -webkit-transition:max-height 1s ease-in; transition:max-height .3s ease-in; } .ubermenu-responsive.ubermenu-items-align-center{     text-align:left; } .ubermenu-responsive.ubermenu{ margin:0; } .ubermenu-responsive.ubermenu .ubermenu-nav{ display:block; }  .ubermenu-responsive.ubermenu-responsive-nocollapse, .ubermenu-repsonsive.ubermenu-no-transitions{ display:block; max-height:none; }  .ubermenu-responsive.ubermenu-responsive-collapse{ max-height:none; visibility:visible; overflow:visible; } .ubermenu-responsive.ubermenu-responsive-collapse{ max-height:0; overflow:hidden !important; visibility:hidden; } .ubermenu-responsive.ubermenu-in-transition, .ubermenu-responsive.ubermenu-in-transition .ubermenu-nav{ overflow:hidden !important; visibility:visible; } .ubermenu-responsive.ubermenu-responsive-collapse:not(.ubermenu-in-transition){ border-top-width:0; border-bottom-width:0; } .ubermenu-responsive.ubermenu-responsive-collapse .ubermenu-item .ubermenu-submenu{ display:none; }  .ubermenu-responsive .ubermenu-item-level-0{ width:50%; } .ubermenu-responsive.ubermenu-responsive-single-column .ubermenu-item-level-0{ float:none; clear:both; width:100%; } .ubermenu-responsive .ubermenu-item.ubermenu-item-level-0 > .ubermenu-target{ border:none; box-shadow:none; } .ubermenu-responsive .ubermenu-item.ubermenu-has-submenu-flyout{ position:static; } .ubermenu-responsive.ubermenu-sub-indicators .ubermenu-submenu-type-flyout .ubermenu-has-submenu-drop > .ubermenu-target:after{ content:"\f107"; }  .ubermenu-responsive .ubermenu-nav .ubermenu-item .ubermenu-submenu.ubermenu-submenu-drop{ width:100%; min-width:100%; max-width:100%; top:auto; left:0 !important; } .ubermenu-responsive.ubermenu-has-border .ubermenu-nav .ubermenu-item .ubermenu-submenu.ubermenu-submenu-drop{ left: -1px !important; /* For borders */ } .ubermenu-responsive .ubermenu-submenu.ubermenu-submenu-type-mega > .ubermenu-item.ubermenu-column{ min-height:0; border-left:none;  float:left; /* override left/center/right content alignment */ display:block; } .ubermenu-responsive .ubermenu-item.ubermenu-active > .ubermenu-submenu.ubermenu-submenu-type-mega{     max-height:none;     height:auto;/*prevent overflow scrolling since android is still finicky*/     overflow:visible; } .ubermenu-responsive.ubermenu-transition-slide .ubermenu-item.ubermenu-in-transition > .ubermenu-submenu-drop{ max-height:1000px; /* because of slide transition */ } .ubermenu .ubermenu-submenu-type-flyout .ubermenu-submenu-type-mega{ min-height:0; } .ubermenu.ubermenu-responsive .ubermenu-column, .ubermenu.ubermenu-responsive .ubermenu-column-auto{ min-width:50%; } .ubermenu.ubermenu-responsive .ubermenu-autoclear > .ubermenu-column{ clear:none; } .ubermenu.ubermenu-responsive .ubermenu-column:nth-of-type(2n+1){ clear:both; } .ubermenu.ubermenu-responsive .ubermenu-submenu-retractor-top:not(.ubermenu-submenu-retractor-top-2) .ubermenu-column:nth-of-type(2n+1){ clear:none; } .ubermenu.ubermenu-responsive .ubermenu-submenu-retractor-top:not(.ubermenu-submenu-retractor-top-2) .ubermenu-column:nth-of-type(2n+2){ clear:both; }   .ubermenu.ubermenu-responsive .ubermenu-tabs, .ubermenu.ubermenu-responsive .ubermenu-tabs-group, .ubermenu.ubermenu-responsive .ubermenu-tab, .ubermenu.ubermenu-responsive .ubermenu-tab-content-panel{ /** TABS SHOULD BE 100%  ACCORDION */ width:100%; min-width:100%; max-width:100%; left:0; } .ubermenu.ubermenu-responsive .ubermenu-tabs, .ubermenu.ubermenu-responsive .ubermenu-tab-content-panel{ min-height:0 !important;/* Override Inline Style from JS */ } .ubermenu.ubermenu-responsive .ubermenu-tabs{ z-index:15; } .ubermenu.ubermenu-responsive .ubermenu-tab-content-panel{ z-index:20; } /* Tab Layering */ .ubermenu-responsive .ubermenu-tab{ position:relative; } .ubermenu-responsive .ubermenu-tab.ubermenu-active{ position:relative; z-index:20; } .ubermenu-responsive .ubermenu-tab > .ubermenu-target{ border-width:0 0 1px 0; } .ubermenu-responsive.ubermenu-sub-indicators .ubermenu-tabs > .ubermenu-tabs-group > .ubermenu-tab.ubermenu-has-submenu-drop > .ubermenu-target:after{ content:"\f107"; }  .ubermenu-responsive .ubermenu-tabs > .ubermenu-tabs-group > .ubermenu-tab > .ubermenu-tab-content-panel{ top:auto; border-width:1px; } .ubermenu-responsive .ubermenu-tab-layout-bottom > .ubermenu-tabs-group{ /*position:relative;*/ }   .ubermenu-reponsive .ubermenu-item-level-0 > .ubermenu-submenu-type-stack{ /* Top Level Stack Columns */ position:relative; }  .ubermenu-responsive .ubermenu-submenu-type-stack .ubermenu-column, .ubermenu-responsive .ubermenu-submenu-type-stack .ubermenu-column-auto{ /* Stack Columns */ width:100%; max-width:100%; }   .ubermenu-responsive .ubermenu-item-mini{ /* Mini items */ min-width:0; width:auto; float:left; clear:none !important; } .ubermenu-responsive .ubermenu-item.ubermenu-item-mini > a.ubermenu-target{ padding-left:20px; padding-right:20px; }   .ubermenu-responsive .ubermenu-item.ubermenu-hide-mobile{ /* Hiding items */ display:none !important; }  .ubermenu-responsive.ubermenu-hide-bkgs .ubermenu-submenu.ubermenu-submenu-bkg-img{ /** Hide Background Images in Submenu */ background-image:none; } .ubermenu.ubermenu-responsive .ubermenu-item-level-0.ubermenu-item-mini{ min-width:0; width:auto; } .ubermenu-vertical .ubermenu-item.ubermenu-item-level-0{ width:100%; } .ubermenu-vertical.ubermenu-sub-indicators .ubermenu-item-level-0.ubermenu-item-has-children > .ubermenu-target:after{ content:'\f107'; } .ubermenu-vertical .ubermenu-item.ubermenu-item-level-0.ubermenu-relative.ubermenu-active > .ubermenu-submenu-drop.ubermenu-submenu-align-vertical_parent_item{     top:auto; } .ubermenu-responsive-toggle{ display:block; }
}
@media screen and (max-width: 480px){
  .ubermenu.ubermenu-responsive .ubermenu-item-level-0{ width:100%; } .ubermenu.ubermenu-responsive .ubermenu-column, .ubermenu.ubermenu-responsive .ubermenu-column-auto{ min-width:100%; }
}


/** UberMenu Custom Menu Styles (Customizer) **/
/* main */
.ubermenu-main .ubermenu-item .ubermenu-submenu-drop { -webkit-transition-duration:700ms; -ms-transition-duration:700ms; transition-duration:700ms; }
.ubermenu-main.ubermenu-transition-fade .ubermenu-item .ubermenu-submenu-drop { margin-top:0; }


/* Status: Loaded from Transient */

</style>

</head>
<body ng-controller="BodyController">

<?php

$this->beginBody ()?>



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
                <?php if(false){ ?>
                <p><a class="login" id="loginlink" href="<?=Yii::getAlias ( '@web' )?>/site/login" ><mat-icon class="material-icons">lock</mat-icon> Login</a></p>
                <?php } ?>
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
                    		<li id="menu-item-2567" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-current-menu-item ubermenu-item-has-children ubermenu-item-2567 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega">
                    			<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" tabindex="0" href="<?=Yii::getAlias ( '@web' )?>/site/candidate">
                    				<span class="ubermenu-target-title ubermenu-target-text">FÜR BEWERBER</span>
                    			</a>
                    			<ul class="ubermenu-submenu ubermenu-submenu-id-2567 ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-full_width ubermenu-submenu-content-align-center">
                    				<li class=" ubermenu-autocolumn menu-item-2567-col-0 ubermenu-item-level-1 ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-2567-col-0">
                    					<ul class="ubermenu-submenu ubermenu-submenu-id-2567-col-0 ubermenu-submenu-type-stack">
                    						<li class=" ubercolumn-specialclass ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-has-children ubermenu-item-555 ubermenu-item-level-2 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-555">
                    							<ul class="ubermenu-submenu ubermenu-submenu-id-555 ubermenu-submenu-type-stack">
                    								<li id="menu-item-562" class="title-submenuuber no-hover ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-562 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only">
                    										<span class="ubermenu-target-title ubermenu-target-text">BRANCHEN</span>
                    									</a>
                    								</li>
                    								<li ng-repeat="branch in branchs " class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-2570 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/branchview/candidate/{{branch.shortcut}}">
                    										<span class="ubermenu-target-title ubermenu-target-text">{{branch.label}}</span>
                    									</a>
                    								</li>
                    							</ul>
                    						</li>
                    						<li class=" ubercolumn-specialclass ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-has-children ubermenu-item-556 ubermenu-item-level-2 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-556">
                    							<ul class="ubermenu-submenu ubermenu-submenu-id-556 ubermenu-submenu-type-stack">
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-2576 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/whyjob2job">
                    										<span class="ubermenu-target-title ubermenu-target-text">WARUM JOB2JOB?</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-2577 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/freelance">
                    										<span class="ubermenu-target-title ubermenu-target-text">ÜBER ZEITARBEIT</span>
                    									</a>
                    								</li>
                    								<li class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-2577 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/carrier">
                    										<span class="ubermenu-target-title ubermenu-target-text">KARRIERE</span>
                    									</a>
                    								</li>
                    							</ul>
                    						</li>
                    					</ul>
                    				</li>
                    			</ul>
                    		</li>
                    		<?php }
							if ($user->isGuest || $identity->isCompany ()) { ?>
                    		<li id="menu-item-2568" class="ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-has-children ubermenu-item-2568 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega">
                    			<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/company" tabindex="0">
                    				<span class="ubermenu-target-title ubermenu-target-text">FÜR UNTERNEHMER</span>
                    			</a>
                    			<ul class="ubermenu-submenu ubermenu-submenu-id-2568 ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-full_width ubermenu-submenu-content-align-center">
                    				<li class=" ubermenu-autocolumn menu-item-2568-col-0 ubermenu-item-level-1 ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-2568-col-0">
                    					<ul class="ubermenu-submenu ubermenu-submenu-id-2568-col-0 ubermenu-submenu-type-stack">
                    						<li class="ubercolumn-specialclass ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-has-children ubermenu-item-42 ubermenu-item-level-2 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-42">
                    							<ul class="ubermenu-submenu ubermenu-submenu-id-42 ubermenu-submenu-type-stack">
                    								<li id="menu-item-2581" class="title-submenuuber no-hover ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-2581 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" >
                    										<span class="ubermenu-target-title ubermenu-target-text">BRANCHEN</span>
                    									</a>
                    								</li>
                    								<li ng-repeat="branch in branchs" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-2570 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/branchview/company/{{branch.shortcut}}">
                    										<span class="ubermenu-target-title ubermenu-target-text">{{branch.label}}</span>
                    									</a>
                    								</li>
                    							</ul>
                    						</li>
                    						<li class=" ubercolumn-specialclass ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-has-children ubermenu-item-47 ubermenu-item-level-2 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-47">
                    							<ul class="ubermenu-submenu ubermenu-submenu-id-47 ubermenu-submenu-type-stack">
                    								<li id="menu-item-2582" class="title-submenuuber no-hover ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-2582 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" >
                    										<span class="ubermenu-target-title ubermenu-target-text">GESCHÄFTSMODELLE</span>
                    									</a>
                    								</li>
                    								<li id="menu-item-2576" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-2576 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/temporarywork">
                    										<span class="ubermenu-target-title ubermenu-target-text">ARBEITNEHMERÜBERLASSUNG</span>
                    									</a>
                    								</li>
                    								<li id="menu-item-2577" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-2577 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/personaladoption">
                    										<span class="ubermenu-target-title ubermenu-target-text">PERSONALÜBERNAHME</span>
                    									</a>
                    								</li>
                    								<li id="menu-item-2577" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-2577 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    									<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/personalrecruitment">
                    										<span class="ubermenu-target-title ubermenu-target-text">PERSONALREKRUTIERUNG</span>
                    									</a>
                    								</li>
                     							</ul>
                    						</li>
                    					</ul>
                    				</li>
                    				<li class=" ubermenu-autocolumn menu-item-2568-col-1 ubermenu-item-level-1 ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-2568-col-1">
                    				<ul class="ubermenu-submenu ubermenu-submenu-id-2568-col-1 ubermenu-submenu-type-stack">
                    					<li class=" ubercolumn-image ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-has-children ubermenu-item-557 ubermenu-item-level-2 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-557">
                    						<ul class="ubermenu-submenu ubermenu-submenu-id-557 ubermenu-submenu-type-stack">
                    							<li id="menu-item-564" class="no-href-link no-hover ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-564 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    								<br>
                    							</li>
                    						</ul>
                    					</li>
                    				</ul>
                    			</li>
                    		</ul>
                    		</li>
                    		<?php } ?>

                    	<li id="menu-item-17" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-has-children ubermenu-item-17 ubermenu-item-level-0 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-drop ubermenu-has-submenu-mega">
                    		<a href="<?=Yii::getAlias ( '@web' )?>/site/whoweare" class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" tabindex="0">
                    			<span class="ubermenu-target-title ubermenu-target-text">Über Uns</span>
                    		</a>
                    		<ul class="ubermenu-submenu ubermenu-submenu-id-17 ubermenu-submenu-type-mega ubermenu-submenu-drop ubermenu-submenu-align-full_width ubermenu-submenu-content-align-center">
                    			<li class=" ubermenu-autocolumn menu-item-17-col-0 ubermenu-item-level-1 ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-17-col-0">
                    				<ul class="ubermenu-submenu ubermenu-submenu-id-17-col-0 ubermenu-submenu-type-stack">
                    					<li class=" ubercolumn-specialclass ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-has-children ubermenu-item-1567 ubermenu-item-level-2 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-1567">
                    						<ul class="ubermenu-submenu ubermenu-submenu-id-1567 ubermenu-submenu-type-stack">
                    							<li id="menu-item-1757" class="title-submenuuber no-hover ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-1757 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    								<span class="ubermenu-target-title ubermenu-target-text">ÜBER UNS</span>
                    							</li>
                    							<li id="menu-item-20247" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-20247 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    								<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/whatwedo">
                    									<span class="ubermenu-target-title ubermenu-target-text">Was wir machen</span>
                    								</a>
                    							</li>
                    							<li id="menu-item-1561" class="no-hover ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-1561 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    								<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/certificates">
                    									<span class="ubermenu-target-title ubermenu-target-text">Zertifikate</span>
                    								</a>
                    							</li>
                    							<li id="menu-item-7490" class="ubermenu-item ubermenu-item-type-post_type ubermenu-item-object-page ubermenu-item-7490 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
                    								<a class="ubermenu-target ubermenu-item-layout-default ubermenu-item-layout-text_only" href="<?=Yii::getAlias ( '@web' )?>/site/partnerassociation">
                    									<span class="ubermenu-target-title ubermenu-target-text">Partner & Verbände</span>
                    								</a>
                    							</li>
                    						</ul>
                    					</li>
                    				</ul>
                    			</li>
                    			<li class=" ubermenu-autocolumn menu-item-17-col-1 ubermenu-item-level-1 ubermenu-column ubermenu-column-1-2 ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-17-col-1">
                    				<ul class="ubermenu-submenu ubermenu-submenu-id-17-col-1 ubermenu-submenu-type-stack">
                    					<li class=" ubercolumn-image ubermenu-item ubermenu-item-type-custom ubermenu-item-object-ubermenu-custom ubermenu-item-has-children ubermenu-item-3305 ubermenu-item-level-2 ubermenu-column ubermenu-column-auto ubermenu-has-submenu-stack ubermenu-item-type-column ubermenu-column-id-3305">
                    						<ul class="ubermenu-submenu ubermenu-submenu-id-3305 ubermenu-submenu-type-stack">
                    							<li id="menu-item-3306" class="no-href-link no-hover ubermenu-item ubermenu-item-type-custom ubermenu-item-object-custom ubermenu-item-3306 ubermenu-item-auto ubermenu-item-normal ubermenu-item-level-3 ubermenu-column ubermenu-column-auto">
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
    	 	<div class="mobilejobsuche">
    	 		<p><a href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs">JOB SUCHEN</a></p>
    	 	</div>
    		<div class="menu-responsive-menu-container"><ul id="menu-responsive-menu" class="menu"><li id="menu-item-3908" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-2 current_page_item"><a href="<?=Yii::getAlias ( '@web' )?>">STARTSEITE</a></li>
                <li id="menu-item-3888" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3888"><a>FÜR BEWERBER<span class="opensubmenumob"></span></a>
                <ul class="sub-menu">
                	<li id="menu-item-1651" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1651"><a >FÜR BEWERBER – Allgemein</a></li>

                	<li  ng-repeat="branch in branchs " class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3293"><a href="<?=Yii::getAlias ( '@web' )?>/{{branch.url}}">{{branch.label}}</a></li>

                	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3288"><a href="<?=Yii::getAlias ( '@web' )?>/site/carrier">KARRIERE</a></li>

                	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3288"><a href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs">Zur Jobsuche</a></li>
                </ul>
                </li>
                <li id="menu-item-3887" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3887"><a >FÜR UNTERNEHMER<span class="opensubmenumob"></span></a>
                <ul class="sub-menu">
                	<li id="menu-item-1652" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1652"><a >FÜR UNTERNEHMER – Allgemein</a></li>

                	<li  ng-repeat="branch in branchs " class="menu-item menu-item-type-post_type menu-item-object-page "><a href="<?=Yii::getAlias ( '@web' )?>/{{branch.url}}">{{branch.label}}</a></li>
                </ul>
                </li>
                <li id="menu-item-3889" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-3889"><a href="<?=Yii::getAlias ( '@web' )?>/site/whoweare" >Über Uns<span class="opensubmenumob"></span></a>
                <ul class="sub-menu">
                	<li id="menu-item-1655" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-1655"><a  href="<?=Yii::getAlias ( '@web' )?>/site/whoweare">ÜBER UNS – Allgemein</a></li>
                	<li id="menu-item-7492" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7492"><a href="<?=Yii::getAlias ( '@web' )?>/partnerassociation">Partner & Verbände</a></li>
                	<li id="menu-item-3301" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3301"><a href="<?=Yii::getAlias ( '@web' )?>/unsere-vision/">Unsere Vision</a></li>
                	<li id="menu-item-3302" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3302"><a href="<?=Yii::getAlias ( '@web' )?>/referenzen/">Referenzen</a></li>
                </ul>
                </li>
                <li id="menu-item-4512" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-4512"><a href="<?=Yii::getAlias ( '@web' )?>/kontakt/">Kontakt</a></li>
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
<div class="bottom-footer no-print" layout="row" layout-align="center center" >
	<div class="footer-child">
        <div style="font-size:12px; line-height: 20px;"><b>Job2Job GmbH</b></div>
        Pyrmonter Straße 42<br>
        31789 Hameln<br>
		<a href="tel:+4951515569430">+49 5151/55694-30</a><br>
	</div>
	<div class="footer-child">
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
	<div class="footer-child">
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
