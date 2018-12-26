<?php

/* @var $this yii\web\View */
/* @var $showSearch boolean */
/* @var $showMoreFromBranch boolean */
/* @var $jobModels array */
/* @var $forTitle string */
/* @var $shortCut string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$user = Yii::$app->user;
$identity = Yii::$app->user->identity;

$showSearch = isset($showSearch) ? $showSearch : false;
$showMoreFromBranch = isset($showMoreFromBranch) ? $showMoreFromBranch : false;

?>


    <div class="blue-section-aktuelle ">
    	<div class="content-center">
    		<h2>AKTUELLE STELLENANGEBOTE<br>
    		<strong><?php echo $forTitle; ?></strong></h2>
			<div class="boxes-aktuelle boxesnumber4">
			<?php
                foreach ( $jobModels as $jobModel ) {
							$jobtitle = $jobModel->title; // strlen($jobModel->title) > 32 ? substr($jobModel->title , 0 , 30) . ' ...' : $jobModel->title;
							?>
				<div class="box-aktuelle" style="position:relative;" onclick="location.href='<?=Yii::getAlias ( '@web' )?>/site/jobview?id=<?php echo $jobModel->id; ?>'">
					<h4><?php echo $jobtitle?></h4>
					<div style="margin: 10px 0;"><?php echo $jobModel->city?></div>
					<div style="max-height:220px; height:220px; overflow:hidden; ">
						<?php echo $jobModel->comments?>
					</div>
					<p style="margin-top: 15px;">
						<a href="<?=Yii::getAlias ( '@web' )?>/site/jobview?id=<?php echo $jobModel->id; ?>">Mehr erfahren &gt;</a>
					</p>
				</div>
			<?php } ?>

			</div>
			<div class="button-aktuelle">
    			<?php if($showSearch){ ?>	
    			<p><a href="<?=Yii::getAlias ( '@web' )?>/site/searchjobs/">JOB SUCHEN</a></p>
    			<?php } ?>
    			<?php if($showMoreFromBranch){ ?>	
    			<?php ActiveForm::begin(['action' => Yii::getAlias('@web') . '/site/searchjobs']) ?>
    			<input type="hidden" value="<?php echo $shortCut;?>" name="searchBranch">
    			<button>UND MEHR</button>
    			<?php ActiveForm::end() ?>
    			<?php } ?>
			</div>
    	</div>
    </div>

