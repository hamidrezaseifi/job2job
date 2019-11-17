<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\lib\UsersBase;

/* @var $this yii\web\View */
/* @var $model common\lib\UsersBase */
/* @var $form yii\widgets\ActiveForm */
/* @var $groups_list array */
/* @var $permissions_list array */
/* @var $status_list array */
/* @var $usertype_list array */
/* @var $message string */


?>

<div class="users-base-form">

    <?php $form = ActiveForm::begin(['id' => 'mainform' , ]); ?>

    <?= $form->field($model, 'uname')->textInput(['maxlength' => true , 'id' => 'txtuname' , 'required' => 'required' , 'type' => 'email' , ]) ?>
	
	<?php if($model->isNewRecord){
		echo $form->field($model, 'password_hash')->passwordInput(['maxlength' => true , 'required' => 'required' , 'pattern' => '(?=.*[a-zA-Z]).{4,}' , 'onchange' => 'mainform.txtconfirm.pattern = this.value;']);
				
		echo Html::label(Yii::t('app', 'Confirm'));
		echo Html::passwordInput('' , '' , [ 'class' => 'form-control' , 'id' => 'txtconfirm' , 'required' => 'required' , 'pattern' => '' , ]) . '<br>';
		
		echo  (Html::label(Yii::t('app', 'Show Password')) .' &nbsp; ' . Html::checkbox('' , false , ['onclick' => 'show_password(this);'])) . '<br><br>';
		
	}?>
    
	
    <?= $form->field($model, 'fname')->textInput(['maxlength' => true , 'required' => 'required' , 'pattern' => '\w+' , ]) ?>

    <?= $form->field($model, 'lname')->textInput(['maxlength' => true , 'required' => 'required' , 'pattern' => '\w+' , ]) ?>

    <?= $form->field($model, 'bdate')->textInput(['maxlength' => true , 'required' => 'required', 'class' => 'form-control calender-icon'  ]) ?>

	<?= $form->field($model, 'usertype')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'group')->dropDownList($groups_list) ?>

    <?= $form->field($model, 'permission')->dropDownList($permissions_list) ?>

    <?= $form->field($model, 'status')->radioList($status_list) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>

$(document).ready(function(){
	
	$('#txtuname').focus();
	
});

function submit_form()
{
	$('#txtconfirm').val($.trim($('#txtconfirm').val()));
	$('#usersbase-uname').val($.trim($('#usersbase-uname').val()));
	$('#usersbase-password_hash').val($.trim($('#usersbase-password_hash').val()));
	$('#usersbase-fname').val($.trim($('#usersbase-fname').val()));
	$('#usersbase-lname').val($.trim($('#usersbase-lname').val()));

	
	alert($("#mainform").attr("onsubmit"));
	$("#mainform").attr("onsubmit" , "");
	alert($("#mainform").attr("onsubmit"));
	
	$("#mainform").submit();
	
	return true;
}

function show_password(check)
{
	if( check.checked)
	{
		$('#txtconfirm')[0].setAttribute('type','text');
		$('#usersbase-password_hash')[0].setAttribute('type','text');
	}
	else
	{
		$('#txtconfirm')[0].setAttribute('type','password');
		$('#usersbase-password_hash')[0].setAttribute('type','password');
	}

	
}


	$(document).ready(function(){
		$.datepicker.setDefaults($.datepicker.regional["de"]);
		$("input.calender-icon").datepicker({
		      changeMonth: true,
		      changeYear: true,
		      maxDate: "-17Y"
		    });

	});
</script>
