<?php

/* @var $this yii\web\View */
/* @var $showSearch boolean */
/* @var $showEmployeeFinder boolean */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$user = Yii::$app->user;
$identity = Yii::$app->user->identity;

$showEmployeeFinder = isset($showEmployeeFinder) ? $showEmployeeFinder : false;

$employeefinderlink = Yii::getAlias('@web') . "/site/register";

if (! $user->isGuest && $identity->isCompany ()) {
    $employeefinderlink = Yii::getAlias('@web') . "/company/dashboard/newjob";
}

?>

			<div class="light-and-bold text-over-image text-up-left" >Text oben links Text oben links Text oben links</div>

			<div class="light-and-bold text-over-image text-up-right" >Text oben recht Text oben recht Text oben recht</div>

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
    			<a href="<?php echo $employeefinderlink;?>">PERSONAL FINDEN</a>
   			</div>
			<?php } ?>

