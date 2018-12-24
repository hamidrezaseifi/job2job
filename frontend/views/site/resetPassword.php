<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\lib\UsersBase */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile("@web/web/css/login.css", [], 'css-login');

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login">
    
    <div class="login-title j2jgreenback">
    	<?php echo Yii::t('app', 'Passwort anfordern'); ?>
    </div>
    
    <div class="login-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div style="clear:both;"></div>
    
    <?php if($model->isNewRecord) 
    	{
    	$form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="login-teil login-personamgabe-teil">
	    
	    <div style="margin-left: 20px; margin-bottom: 10px; height:24px;" class="error_text"><?php echo $message;?></div>
	    <div class="login-teil-items-container">
			<div class=""><?php echo Yii::t('app', 'Email-Adresse'); ?></div>  	
	    	<?= $form->field($model, 'uname')->textInput(['autofocus' => true , 'type' => 'email' , 'class' => 'requireditem'
	    	])->label(false) ?>
	    	

	    </div>
    	
    	<div style="clear:both;"></div>
    </div>
  
  
    
	<div class="login-teil login-condition-teil">
	 	<div class="login-teil-items-container"  style=" float: right; width: 50%;">
			
			<button type="submit" class="login-senden j2jgreenback"><?php echo Yii::t('app', 'Passwort anfordern'); ?></button>

	 	</div>
 	</div>   
 	    
    <?php 
    ActiveForm::end() ;
	}
    else {
    ?>
    	<div style="margin-top: 50px; margin-bottom: 40px; width: 80%; margin-left: 64px;" class="message1">
    	<?php echo $message;?>
    	</div>
    	<br><br>
		<div class="login-teil login-condition-teil">
			<a href="<?=Yii::getAlias('@web') ?>" class=" ">
			 	<div class="login-teil-items-container j2jgreenback login-senden "  style=" float: right; width: 50%; color: rgb(51, 51, 51);">
					<?php echo Yii::t('app', 'Home'); ?>
			 	</div>
		 	</a>
	 	</div>   
    	
    <?php } ?>
</div>

