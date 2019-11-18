<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\lib\UsersBase;

/* @var $this yii\web\View */
/* @var $model common\lib\UsersBase */
/* @var $groups_list array */
/* @var $message string */

$this->title = Yii::t('app', 'Kennwort ersetzen');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Benuzer'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fullname(), 'url' => ['view', 'id' => $model->id]];
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
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Bearbeiten'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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

function submit_form()
{
	$('#usersbase-password_hash').val($.trim($('#usersbase-password_hash').val()));

	
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

</script>

