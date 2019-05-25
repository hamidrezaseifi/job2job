<?php

/* @var $this yii\web\View */
/* @var $showSearch boolean */
/* @var $firstPage boolean */
/* @var $candidatePage boolean */
/* @var $companyPage boolean */
/* @var $showEmployeeFinder boolean */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$user = Yii::$app->user;
$identity = Yii::$app->user->identity;

$firstPage = isset($firstPage) ? $firstPage : false;
$candidatePage = isset($candidatePage) ? $candidatePage : false;
$companyPage = isset($companyPage) ? $companyPage : false;
$showEmployeeFinder = isset($showEmployeeFinder) ? $showEmployeeFinder : false;

$employeefinderlink = Yii::getAlias('@web') . "/site/register";

if (! $user->isGuest && $identity->isCompany ()) {
    $employeefinderlink = Yii::getAlias('@web') . "/company/dashboard/newjob";
}

?>
					
			<?php if($firstPage){?>
			
			<div class="header-banner-box header-banner-box-left" >„Job2Job Personaldienstleistungen - Wir bringen Interessen zusammen“</div>
			
			<?php } ?>
			
			<?php if($candidatePage){?>
			
			<div class="header-banner-box header-banner-box-right" >„Zeitnah und ressourcenschonend den ‚perfekten‘ Mitarbeiter finden? Das geht nur mit einem gut vernetzten Partner.“</div>
			
			<?php } ?>
			
			<?php if($companyPage){?>
			
			<div class="header-banner-box header-banner-box-right" >„Zeitnah und ressourcenschonend den ‚perfekten‘ Mitarbeiter finden? Das geht nur mit einem gut vernetzten Partner.“ </div>
			
			<?php } ?>
			
			<?php if($showSearch && false){?>
			<div class="header-banner-box header-banner-box-left-350" >
				Job Suche<br><br>
				<p><a href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs" class="header-banner-link">JOB SUCHEN</a></p>				
			</div>
			<?php } ?>
			
			<?php if($showEmployeeFinder && false){?>
			<div class="header-banner-box header-banner-box-left-450" >
				PERSONAL FINDEN<br><br>
				<p><a href="<?php echo $employeefinderlink;?>" class="header-banner-link">JETZT QUALIFIZIERTES PERSONAL FINDEN</a></p>				
			</div>
			<?php } ?>
			
			

