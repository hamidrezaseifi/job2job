<?php
/* @var $this yii\web\View */
/* @var $jobitems string */

use yii\helpers\Html;


?>

<div class="general-pagetitle j2jgreenback">
	<?php echo Yii::t('app', 'Stellenanzeigen'); ?>
</div>

<div class="index-part-2" id="index-part-2">
	<div class="index-part-2-in">
			
		<div class="index-part-2-title" style=" "> <?php echo Yii::t('app', 'Jobs der Woche'); ?> </div>
		
		<div class="index-part-2-job_title" style=" "> <?php echo Yii::t('app', 'Bezeichnung'); ?> </div>
		<div class="index-part-2-ort_title" style=" "> <?php echo Yii::t('app', 'Ort'); ?> </div>
		
		<?php echo $jobitems;?>
		
		<div style="height: 50px; clear: both;" id="afterlastjobpos"></div>
		<div class="index-part-2-title" id="nextjoblinkcontainer" style=" "><a href="#" onclick="nextJob(this); return false;"> <?php echo Yii::t('app', 'weitere ...'); ?></a> 
		<img src="<?php echo Yii::getAlias('@web')?>/web/images//loading.gif" width="70" id="nextjobloading" />
		</div>

				
	</div>
	<div class="clear"></div>
</div>


<script type="text/javascript">

var nextjoburl = "<?php echo Yii::getAlias('@web')?>/site/nextjob";
var part_2_showed = false;
var nextjobcount = 5;


</script>