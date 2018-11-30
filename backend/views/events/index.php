<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $logModels common\lib\FrontlogBase */
/* @var $logList array */

$this->registerCssFile("@web/web/css/logs.css");

$this->title = Yii::t('app', 'Fronend Geschehen ...');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frontlog-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="lastlog"><img id="imgloading" style="display: none;" width="30" src="<?php echo Yii::getAlias('@web'); ?>/web/images/loading.gif"></div>
    
    <?php 
    $lastid = 0;
    	/*foreach ($logList as $log)
    	{
    		$lastid = $lastid == 0 ? $log['id'] : $lastid;
    		echo '<div class="logdiv">' . $log['desc'] . '</div>';
    	}*/
    	
    	
    ?>
    
<script type="text/javascript">
	var lastlogid = <?php echo $lastid;?>;

	function loadnext()
	{
		$("#imgloading").show();

		/*$.get("nextlog?lastid=" + lastlogid , function( data ){
			alert(data);
		});*/
		
		$.getJSON( "nextlog?lastid=" + lastlogid , function( data ) {

			$("#imgloading").hide();
			  $.each( data, function( index, item ) {
			    	$('<div class="logdiv">' + item.desc + '</div>').insertAfter(".lastlog");
			    	lastlogid = item.id;
			  });

			  setTimeout(function(){ loadnext(); }, 3000);
		});
		
	}

	$(document).ready(function(){
		loadnext();
	}); 
</script>

    <?php /*echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'userid',
            'logdesc',
            'iscandidate',
            'logdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);*/ ?>
</div>
