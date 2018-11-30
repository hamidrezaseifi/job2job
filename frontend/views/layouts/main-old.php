<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;
use common\lib\LanguagesBase;
use yii\widgets\ActiveForm;
use frontend\controllers\CandidateController;
use frontend\controllers\CompanyController;

AppAsset::register($this);

$photopath = false;

if(!Yii::$app->user->isGuest)
{
	$photopath = false;
	if(Yii::$app->user->identity->isCandidate())
	{
		$photopath = CandidateController::personal_photo(true);
	}
	
	if(Yii::$app->user->identity->isCompany())
	{
		$photopath = CompanyController::company_logo(true);
	}
		
	if($photopath)
	{
		$photopath = $photopath && is_string($photopath) ? $photopath : Yii::getAlias('@web') . '/web/images/person2.png';
	}
}
if(!$photopath)
{
	$photopath = Yii::getAlias('@web') . '/web/images/person2.png';
}

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="brainApp">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->params['sitetitle']) ?></title>
    <?php $this->head() ?>
    <link rel="icon" type="image/png" href="<?=Yii::getAlias('@web/web/images') ?>/site-icon.jpg">
    
    <script src="<?=Yii::getAlias('@web') ?>/web/js/mainlayout.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web/web') ?>/js/datepicker-de.js"></script>
<script type="text/javascript">


</script>
    
</head>
<body ng-controller="BodyController">
<script type="text/javascript">
var cityurl = "<?php echo Yii::getAlias('@web/site/allcities'); ?>";
var postcodeurl = "<?php echo Yii::getAlias('@web/site/allpostcodes'); ?>";
var placesurl = "<?php echo Yii::getAlias('@web/site/allplaces'); ?>";
</script>
<?php $this->beginBody() ?>

<div class="wrap">
    
<div class="topmenu" id="topmenu">
<table  style="width: 100%;">
	<tr>
		<td style="width: 200px; text-align: left;">
			<div class="topmenulogo"> 
				<a href="<?=Yii::getAlias('@web') ?>"><img id="mainlogo" width="165" height="66" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></a><br>
				<div id="langflags">
		<?php 
		$languages = LanguagesBase::find()->where(['status' => 1])->orderBy('index')->all();
		
		foreach ($languages as $language){
			echo '<a href="javascript:void()" data-lang="' . $language->id . '"><img alt="' . $language->title . '" src="' . Yii::getAlias('@web') . $language->photourl . '" class="topmenuflag" title="' . $language->title . '" ></a>';
		}
		?>			</div>
			</div>
		</td>
		<td style="text-align: center; vertical-align: bottom;">
			<div class="topmenumiddlemenu">
				<?php if(Yii::$app->user->isGuest || Yii::$app->user->identity->isCandidate()){?>
				<a href="javascript:void()" id="bewerberlink" ng-click="bewerberlinkclick()"><?php echo Yii::t('app', 'Für Bewerber'); ?></a>
				<?php } else {?>
				<a href="<?=Yii::getAlias('@web/company/dashboard') ?>" id="dashboardlink"><?php echo Yii::t('app', 'Mein Dashboard'); ?></a>
				<?php } ?>
				 &nbsp;  &nbsp;
				<?php if(Yii::$app->user->isGuest || Yii::$app->user->identity->isCompany()){?>
				<a href="javascript:void()" id="unternehmenlink" ng-click="unternehmenlinkclick()"><?php echo Yii::t('app', 'Für Unternehmen'); ?></a>
				<?php } else {?>
				<a href="<?=Yii::getAlias('@web/candidate/dashboard') ?>" id="dashboardlink"><?php echo Yii::t('app', 'Mein Dashboard'); ?></a>
				<?php } ?>
			</div>
		</td>
		<td style="width: 70px; text-align: center;"><?php if(Yii::$app->user->isGuest){?>
			<a href="javascript:void()" id="toploginlink" onclick="show_login(this); return false;"><?php echo Yii::t('app', 'Login'); ?></a>
			<?php } else { ?>
			<a href="javascript:void()" id="topuserlink" onclick="return false;">
				<img src="<?=$photopath ?>" alt="" class="personalphoto" ng-click="personalphoto_click()" >
			</a>
			<?php } ?>
		</td>
		<td style="width: 120px; text-align: right; padding-right: 30px;">
		</td>
	</tr>
</table>
	
</div>

<div id="menu-line" ng-click="menulineclick()" class="close">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
</div>
<a href="<?=Yii::getAlias('@web') ?>"><img id="mainlogotop" alt="" width="165" height="66" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></a>
 <?= $content ?>

<div class="footer j2jgreentext">Telefon <a class="j2jgreentext" href="tel:051515569430">05151 - 5569430</a> &nbsp; &nbsp; <div class="bluecircle"></div> &nbsp; &nbsp; E-Mail: <a class="j2jgreentext" href="mailto:info@job2job-gmbh.de">info@job2job-gmbh.de</a> &nbsp; &nbsp;<div class="bluecircle"></div> &nbsp; &nbsp; <a class="j2jgreentext" href="http://www.job2job-gmbh.de">www.job2job-gmbh.de</a></div>
</div>
<?php if(Yii::$app->user->isGuest || Yii::$app->user->identity->isCompany()){?>
<div id="unternehmenmenu" ng-click="doclosemenu()" class="fullmenu fullmenuunternehmer">
	<div id="unternehmensubmenu">
		<div class="menuline menutitle"><?php echo Yii::t('app', 'UNTERNEHMEN'); ?></div>
		<div><a href="javascript:void()"><?php echo Yii::t('app', 'PERSONALVAKANZ'); ?></a></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/certificates"><?php echo Yii::t('app', 'ZERTIFIKATE'); ?></a></div>
		<div id="dienstleistungenlink" ng-mouseover="dienstleistungenlink_mouseover()"><a href="javascript:void()"><?php echo Yii::t('app', 'DIENSTLEISTUNGEN'); ?></a></div>
		<div class="menuline">&nbsp;</div>
		<?php if(Yii::$app->user->isGuest){?><div><a href="<?=Yii::getAlias('@web') ?>/company/register" class="j2jgreentextforce"><?php echo Yii::t('app', 'JETZT REGISTRIEREN'); ?></a></div>
		<div><a href="javascript:void()" class="j2jgreentextforce" onclick="event.stopPropagation(); show_login(this); return false;"><?php echo Yii::t('app', 'ANMELDEN'); ?></a></div><?php } ?>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/contact" class="j2jgreentextforce"><?php echo Yii::t('app', 'KONTAKT'); ?></a></div>
		
	</div>
</div>
<div id="dienstleistungenmenu" class="dienstleistungenmenu" ng-mouseleave="dienstleistungenmenu_mouseleave()">
	<div id="dienstleistungensubmenu">
		<div><a href="<?=Yii::getAlias('@web') ?>/site/emleasing"><?php echo Yii::t('app', 'ARBEITNEHMERÜBERLASSUNG'); ?></a></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/emadopte"><?php echo Yii::t('app', 'PERSONALÜBERNAHME'); ?></a></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/emrecruitment"><?php echo Yii::t('app', 'PERSONALREKRUTIERUNG'); ?></a></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/emmedical"><?php echo Yii::t('app', 'MEDICAL'); ?></a></div>
	</div>
</div>
<?php } 
 if(Yii::$app->user->isGuest || Yii::$app->user->identity->isCandidate()){?>
<div id="bewerbermenu" ng-click="doclosemenu()" class="fullmenu fullmenubewerber">
	<div id="bewerbersubmenu">
		<div class="menuline menutitle"><?php echo Yii::t('app', 'BEWERBER'); ?></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/allbranches"><?php echo Yii::t('app', 'BRANCHEN'); ?></a> </div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/searchjobs"><?php echo Yii::t('app', 'JOB SUCHE'); ?></a> </div>
		<?php if(false){?>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=med"><?php echo Yii::t('app', 'JOB2JOB - MED'); ?></a></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=commercial"><?php echo Yii::t('app', 'JOB2JOB - KAUFMÄNNISCH'); ?></a></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/branch?type=engineering"><?php echo Yii::t('app', 'JOB2JOB - ENGINEERING'); ?></a></div>
		<?php } ?>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/temporarywork"><?php echo Yii::t('app', 'ÜBER ZEITARBEIT'); ?></a></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/carrier"><?php echo Yii::t('app', 'KARRIERE INTERN'); ?></a></div>
		<div class="menuline">&nbsp;</div>
		<?php if(Yii::$app->user->isGuest){?><div><a href="<?=Yii::getAlias('@web') ?>/candidate/register" class="j2jgreentextforce"><?php echo Yii::t('app', 'JETZT REGISTRIEREN'); ?></a></div>
		<div><a href="javascript:void()" class="j2jgreentextforce" onclick="event.stopPropagation(); show_login(this); return false;"><?php echo Yii::t('app', 'ANMELDEN'); ?></a></div><?php } ?>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/contact" class="j2jgreentextforce"><?php echo Yii::t('app', 'KONTAKT'); ?></a></div>
	</div>
</div>
<?php } ?>
<div id="mainmenu" class="fullmenu" ng-click="doclosemenu()">
	<div id="mainsubmenu">
		<div><a href="<?=Yii::getAlias('@web') ?>"><?php echo Yii::t('app', 'HOME'); ?></a> </div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/about"><?php echo Yii::t('app', 'ÜBER UNS'); ?></a></div>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/whatwedo"><?php echo Yii::t('app', 'WAS WIR MACHEN'); ?></a></div>
		<?php if(Yii::$app->user->isGuest || Yii::$app->user->identity->isCandidate()){?><div><a href="<?=Yii::getAlias('@web') ?>/site/searchjobs"><?php echo Yii::t('app', 'JOB SUCHE'); ?></a></div><?php } ?>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/contact"><?php echo Yii::t('app', 'KONTAKT'); ?></a></div>
		<br>
		<?php if(Yii::$app->user->isGuest){?><div><a href="javascript:void()" class="j2jgreentextforce" onclick="event.stopPropagation(); show_choose_register(this); return false;"><?php echo Yii::t('app', 'JETZT REGISTRIEREN'); ?></a> / 
		<a href="javascript:void()" class="j2jgreentextforce" onclick="event.stopPropagation(); show_login(this); return false;"><?php echo Yii::t('app', 'ANMELDEN'); ?></a></div>
		<?php } else {?>
		<div><a href="<?=Yii::getAlias('@web') ?>/site/logout" class="j2jgreentextforce"><?php echo Yii::t('app', 'ABMELDEN'); ?></a></div>
		<?php } ?>
	</div>
</div>
<?php  if(Yii::$app->user->isGuest){?>

<div id="loginbox" class="">
	<?php ActiveForm::begin(['id' => 'ogin-form' , 'action' => Yii::getAlias('@web/') . 'site/login']) ?>
	<div ><div ><?php echo Yii::t('app', 'E-Mail'); ?></div> <input type="text" name="LoginForm[username]" ></div> 
	<div ><div ><?php echo Yii::t('app', 'Kennwort'); ?></div> <input type="password" name="LoginForm[password]" ></div> 
	<div ><div class="rememberme"><?php echo Yii::t('app', 'Angemeldet bleiben'); ?></div> <input type="checkbox" id="rememberMe" checked="checked" ng-click="rememberme_click()" ><input type="hidden" name="LoginForm[rememberMe]" value="1" ></div> 
	<div ><div class="passforgot"><a href="<?=Yii::getAlias('@web') ?>/site/resetpassword"><?php echo Yii::t('app', 'Forget Password?'); ?></a></div><div style="float: right; clear: none; margin-right: 10px; width:55px; "><input type="submit" name="Login" value="<?php echo Yii::t('app', 'Login'); ?>" ></div></div>
	<?php ActiveForm::end() ?> 
</div>

<div id="registerchoose" class="">
	<a href="<?=Yii::getAlias('@web') ?>/candidate/register" class="j2jgreentextforce"><?php echo Yii::t('app', 'BEWERBER'); ?></a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
	<a href="<?=Yii::getAlias('@web') ?>/company/register" class="j2jgreentextforce"><?php echo Yii::t('app', 'UNTERNEHMEN'); ?></a>
</div>
 <?php } ?>
 
  <?php   if(!Yii::$app->user->isGuest){?>
 <div id="personalmenu" class="">
	<div class="personal-name"><?php echo Yii::t('app', 'Willkommen'); ?><br><?=Yii::$app->user->identity->fullname() ?></div> 
	<div style="margin-bottom: 20px;"><a href="<?=Yii::getAlias('@web') ?>/<?=(Yii::$app->user->identity->isCandidate()? 'candidate' : 'company') ?>/dashboard/myprofile" class=""><?php echo Yii::t('app', 'Mein Profil'); ?></a></div> 
	<div><a href="<?=Yii::getAlias('@web') ?>/site/logout" class=""><?php echo Yii::t('app', 'ABMELDEN'); ?></a></div>
</div>
 
 <?php } ?>
 
 
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
