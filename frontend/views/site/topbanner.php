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

			<div class="light-and-bold text-over-image text-up-left" >„Job2Job Personaldienstleistungen - Wir bringen Interessen zusammen“</div>
			
			<?php if($firstPage){?>
			<div class="light-and-bold text-over-image text-up-right" >
				„Klingt nach Binsenweisheit, ist aber schlicht Realität: Mitarbeiter sind das wichtigste Kapital eines Unternehmens.“
				<br><br>
            	<div class="name">– Madeleine Mohr, Geschäftsführerin der Job2Job GmbH</div>
            </div>
			<?php } ?>
			
			<?php if($candidatePage){?>
			<div class="light-and-bold text-over-image text-up-right" >
				„Faire Löhne, gute Arbeitsbedingungen, berufliche Perspektive: die Philosophie von Job2Job in der Nussschale“
				<br><br>
            	<div class="name">– Madeleine Mohr, Geschäftsführerin der Job2Job GmbH</div>
            </div>
			<?php } ?>

			<?php if($companyPage){?>
			<div class="light-and-bold text-over-image text-up-right" >
				„Zeitnah und ressourcenschonend den ‚perfekten‘ Mitarbeiter finden? Das geht nur mit einem gut vernetzten Partner.“ 
				<br><br>
            	<div class="name">– Madeleine Mohr, Geschäftsführerin der Job2Job GmbH</div>
            </div>
			<?php } ?>

			<?php if($showSearch){?>
			<div class="search-container-over-image" >
				<?php ActiveForm::begin(['action' => Yii::getAlias('@web') . '/site/searchjobs']) ?>
				
					<input type="text" placeholder="JOB SUCHEN" name="searchedText">
					<button><i class="material-icons">search</i></button>
				<?php ActiveForm::end() ?>
				
			</div>
			<?php } ?>

			<?php if($showEmployeeFinder){?>
			<div class="personal-container-over-image" >
    			<a href="<?php echo $employeefinderlink;?>">JETZT QUALIFIZIERTES PERSONAL FINDEN</a>
   			</div>
			<?php } ?>

