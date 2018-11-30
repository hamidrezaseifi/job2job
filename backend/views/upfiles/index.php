<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\UploadedfilesBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'hochgeladene Dateien');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="uploadedfiles-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
        	[
        		'header' => '<input id="chkcheckall" type="checkbox" data-id="" />',
        		'format' => 'raw',
        		'headerOptions' => ['style' => 'width : 20px;'],
        		'value' => function($model){ return '<input type="checkbox" class="checksel" data-id="' . $model->id . '" />' ;}
        	],
        	['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width : 40px;'],],
        	[
        		'label' => Yii::t('app', 'Datei'),
        		'format' => 'raw',
        		//'headerOptions' => ['style' => 'width : 200px;'],
        		'value' => function($model){ return '<a href="' . $model->file . '" target="_blank">' . $model->file . '</a>' ;}
        	],
        	[
	        	'label' => Yii::t('app', 'Benutzer'),
	        	'format' => 'html',
	        	'headerOptions' => ['style' => 'width : 120px;'],
	        	'value' => function($model){ return $model->getUser()->fullname() ;}
        	],
        	 
            //'id',
            //'file',
            //'status',
            //'upload_date',
            //'userid',

            [
            	'class' => 'yii\grid\ActionColumn', 
            	'headerOptions' => ['style' => 'width : 60px;'],
            	'template' => '{delete} {approve}',
            	'header' => '<a href="javascript:deleteall()" title="Löschen" ><span class="glyphicon glyphicon-trash"></span></a> <a href="javascript:approveall()" title="Genehmigen" aria-label="Genehmigen"><span class="glyphicon glyphicon-ok"></span></a>',
            	'buttons' => [
            				'approve' => function ($url, $model, $key) {
            					return '<a href="' . Yii::getAlias('@web') . '/upfiles/approve?id=' . $key . '" title="' . Yii::t('app', 'Genehmigen') . '" aria-label="' . Yii::t('app', 'Genehmigen') . '" data-confirm="' . Yii::t('app', 'Sind Sie sicher, dass Sie diesen Artikel genehmigen möchten?') . '" data-method="post" data-pjax="0" ><span class="glyphicon glyphicon-ok"></span></a>';
            				},
            				'delete' => function ($url, $model, $key) {
            					return '<a href="' . Yii::getAlias('@web') . '/upfiles/delete?id=' . $key . '" title="' . Yii::t('app', 'Löschen') . '" aria-label="' . Yii::t('app', 'Löschen') . '" data-confirm="' . Yii::t('app', 'Sind Sie sicher, dass Sie diesen Artikel löschen möchten?') . '" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>';
            				},
            				
            	],
        	],
        ],
    ]); ?>
</div>
<script>

$(document).ready(function(){
	
	$("#chkcheckall").click(function(){ 
		$(".checksel").prop("checked" , $("#chkcheckall").prop("checked"));

		
	});
	
	$(".checksel").change(function(){ 
		
	});

});

function deleteall()
{
	if($("input.checksel:checked").length > 0){
		if(!confirm("<?php echo Yii::t('app', 'Sind Sie sicher, dass Sie diese Artikel löschen möchten?');?>")){
			return;
		}
		var idlist = getchecked();
		var posturl = "<?php echo Yii::getAlias('@web') ;?>/upfiles/deleteall";
		$.ajax({
			  method: "POST",
			  url: posturl,
			  data: idlist
			})
			  .done(function( msg ) { 
			    if( msg == 'ok' ){
			    	window.location = window.location.href;
				}else{
					alert(msg);
				}
			  });
	}
}

function approveall()
{
	
	if($("input.checksel:checked").length > 0){
		if(!confirm("<?php echo Yii::t('app', 'Sind Sie sicher, dass Sie diese Artikel genehmigen möchten?');?>")){
			return;
		}
		var idlist = getchecked();
		var posturl = "<?php echo Yii::getAlias('@web') ;?>/upfiles/approveall";
		$.ajax({
			  method: "POST",
			  url: posturl,
			  data: idlist
			})
			.done(function( msg ) { 
		    if( msg == 'ok' ){ 
		    	window.location = window.location.href;
			}else{
				alert(msg);
			}
		  });
	}
}

function getchecked()
{
	var idlist = '';
	var t = $("<form></form>");
	
	$("input.checksel:checked").each(function(index, item){
		idlist += $(item).data("id") + ",";
		$("<input type='hidden' name='list[]' value='" + $(item).data("id") + "'>").appendTo(t);
	});	
	//alert(t.serialize());
	
	return t.serialize();
}

</script>