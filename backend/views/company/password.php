<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\lib\UsersBase;

/* @var $this yii\web\View */
/* @var $model common\lib\UsersBase */
/* @var $groups_list array */
/* @var $message string */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unternehmer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname(), 'url' => false];
$this->params['breadcrumbs'][] = Yii::t('app', 'Kennwort');
?>
<div class="users-base-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="users-base-form">

	    <?php $form = ActiveForm::begin(['id' => 'mainform' , ]); ?>
		
		<?php 
			echo Html::label(Yii::t('app', 'Password'));
			echo Html::passwordInput('UsersBase[password_hash]' , '' , [ 'class' => 'form-control' , 'id' => 'usersbase-password_hash' , 'required' => 'required' , 'pattern' => '(?=.*[a-zA-Z]).{4,}'  , 'onchange' => '$("#txtconfirm").attr("pattern" , this.value);', ]) . '<br>';
				
			echo Html::label(Yii::t('app', 'Confirm'));
			echo Html::passwordInput('' , '' , [ 'class' => 'form-control' , 'id' => 'txtconfirm' , 'required' => 'required' , 'pattern' => '(?=.*[a-zA-Z]).{4,}' , ]) . '<br>';
			
			echo  (Html::label(Yii::t('app', 'Show Password')) .' &nbsp; ' . Html::checkbox('' , false , ['onclick' => 'show_password(this);'])) . '<br><br>';
			
		?>
	    	
	    <div class="form-group">
	        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary' , 'onclick' => 'checkPasswords(event);']) ?>
	    </div>
	
	    <?php ActiveForm::end(); ?>
	
		<?php if($message != '') { ?>
		<div class="alert alert-danger"><?=$message ?></div>
		<?php } ?>
	</div>

</div>

<script>

$(document).ready(function(){
	
	$('#txtoldpassword').focus();
	
});

function checkPasswords(event)
{
	event.preventDefault();
	
	$('#usersbase-password_hash').val($.trim($('#usersbase-password_hash').val()));
	$('#txtconfirm').val($.trim($('#txtconfirm').val()));

	if(!validatePassword($('#usersbase-password_hash').val())){
		alert("Das Kennwort muss mindestens eine Zahl, sowie einen Groß- und Kleinbuchstaben und mindestens 6 oder mehr Zeichen enthalten!");
		return;
	}
	

	if($('#usersbase-password_hash').val() != $('#txtconfirm').val()){
		alert("Die Passwörter stimmen nicht überein!");
		return;
	}
	
	$("#mainform").submit();
	
	return true;
}

function validatePassword(text) {
    return (/[A-Z]/.test(text) && /[0-9]/.test(text) && /[a-z]/.test(text) && /[@#$%&!\(\)\"\?\§\=\']/.test(text));
};


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

</script>

