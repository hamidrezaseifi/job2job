<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\lib\CandidatejobapplyBase */

$this->title = Yii::t('app', 'Bewerbung Vorschau');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bewerbungen'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.detail-container
{
	border: 1px solid gray; 
	border-radius: 6px; 
	padding: 10px; 
	padding-left: 20px; 
	padding-right: 20px; 
	margin: 20px;
}

.detail-container .detail-sub
{
	height: 390px; 
	overflow-y: hidden; 
	overflow-x: auto;
}

.detail-container .more
{
	height: 30px; 
	margin-top: 10px;
}

</style>
<div class="candidatejobapply-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Fertig'), ['finish', 'userid' => $model->userid, 'jobposid' => $model->jobposid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'userid' => $model->userid, 'jobposid' => $model->jobposid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Sind Sie sicher, dass Sie diesen Artikel löschen möchten?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
	
	<div class="detail-container candidate-container">
		<div class="detail-sub">
			<?= Yii::$app->controller->renderPartial('../candidate/view' , ['model' => $model->getCandidate(), 'fromapply' => true]); ?>
		</div>
		<div class="more"><span style="cursor: pointer;" data-status="less"><?php echo Yii::t('app', 'mehr ...');?></span></div>
	</div>
    
	<div class="detail-container jobpos-container">
		<div class="detail-sub">
	    <?= Yii::$app->controller->renderPartial('../jobpos/view' , ['model' => $model->getJobpos(), 'fromcompany' => false, 'fromapply' => true]); ?>
		</div>
		<div class="more"><span style="cursor: pointer;" data-status="less"><?php echo Yii::t('app', 'mehr ...');?></span></div>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function(){

	$(".candidate-container .more span").click(function(){
		if($(this).data("status") == "less"){
			
			$(".candidate-container .detail-sub").css("height" , $(".candidate-container .detail-sub div").first().height() + 30);
			$(this).data("status" , "more");
			$(this).html("<?php echo Yii::t('app', 'veniger ...');?>");
		}
		else{
			$(".candidate-container .detail-sub").css("height" , 390);
			$(this).data("status" , "less");
			$(this).html("<?php echo Yii::t('app', 'mehr ...');?>");
		}
			
			
	});
	
	$(".jobpos-container .more span").click(function(){
		
		if($(this).data("status") == "less"){
			$(".jobpos-container .detail-sub").css("height" , $(".jobpos-container .detail-sub div").first().height() + 30);
			$(this).data("status" , "more");
			$(this).html("<?php echo Yii::t('app', 'veniger ...');?>");
		}
		else{
			$(".jobpos-container .detail-sub").css("height" , 390);
			$(this).data("status" , "less");
			$(this).html("<?php echo Yii::t('app', 'mehr ...');?>");
		}
	});
	
});

</script>
