<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


?>

			<div class="light-and-bold text-over-image text-up-left" >Text oben links Text oben links Text oben links</div>

			<div class="light-and-bold text-over-image text-up-right" >Text oben recht Text oben recht Text oben recht</div>

			<div class="search-container-over-image" >
				<?php ActiveForm::begin(['action' => Yii::getAlias('@web') . '/site/searchjobs']) ?>
				
					<input type="text" placeholder="JOB SUCHEN" name="searchedText">
					<button><i class="material-icons">search</i></button>
				<?php ActiveForm::end() ?>
				
			</div>

