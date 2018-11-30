<?php

//jobpositionDataProvider
/* @var $this yii\web\View */
/* @var $jobpositionModels array */


?>
		
		<?php foreach ($jobpositionModels as $jobindex => $jobpositionModel) { 
			$jobtitle = strlen($jobpositionModel->title) > 32 ? substr($jobpositionModel->title , 0 , 30) . ' ...' : $jobpositionModel->title;
		?>
		<a href="<?=Yii::getAlias('@web') ?>/site/jobview?id=<?php echo $jobpositionModel->id;?>">
		<div class="index-part-2-job_item" data-index="<?php echo $jobindex; ?>"> <?php echo $jobtitle;?> </div>
		<div class="index-part-2-ort_item"> <?php echo $jobpositionModel->country . ' / ' . $jobpositionModel->city; ?> </div>
		</a>
		<?php } ?>
		
<?php if($isfinish) {?>
<script>
	
	$("#nextjoblinkcontainer").remove();
</script>
<?php } ?>