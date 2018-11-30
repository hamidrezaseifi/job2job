<?php
/* @var $this yii\web\View */

//echo 'hashpasswords!';
		
//echo Yii::$app->security->generatePasswordHash('sssss');

$this->registerJsFile(Yii::getAlias('@web') . '/web/js/jquery-3.1.0.min.js' , ['position' => $this::POS_HEAD]);

//echo Yii::getAlias('@web');

?>

<br>
<div style="border: 1px solid gray; padding-bottom: 10px; padding-top:0; font-size:12px;">
	<div style="font-size: 20px; padding-bottom: 5px; padding-top:5px;">Password Hash</div>
	<div style="float:left;">Password : <input type="text" id="txtpassword"></div>
	<div style="float:left;">&nbsp;&nbsp;<input type="button" id="btngethash" value="Get Hash">&nbsp;&nbsp;</div>
	<div style="float:left;"><input type="text" id="txthash" style="width: 700px;"></div>
	<div style="clear: both;"></div>
</div>

<script>

$("#btngethash").click(function(){

	//alert($("#txtpassword").val());
	
	var mode = document.designMode;
	document.designMode = "on";

	$("#txtpassword").val($.trim($("#txtpassword").val()));
	if($("#txtpassword").val() == "")
		return;
	
	$("#btngethash").prop('disabled', true);
	$("#txthash").val("");
	$.post("<?php echo Yii::$app->urlManager->createUrl(["utils/gethash"]); ?>" , { text: $("#txtpassword").val()  }  ,function(data){

		$("#txthash").val(data);
		$("#btngethash").prop('disabled', false);

		$("#txthash").focus();
		$("#txthash").select();
		var res = document.execCommand("copy");
		alert(res);
	});
	
});

</script>