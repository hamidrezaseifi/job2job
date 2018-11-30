<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile("@web/web/css/login.css", [], 'css-login');

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="login">
    
    <div class="login-title j2jgreenback">
    	<?php echo Yii::t('app', 'Anmelden'); ?>
    </div>
    
    <div class="login-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div style="clear:both;"></div>
    
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="login-teil login-personamgabe-teil">
	    
	    <div class="login-teil-items-container">
<?php if(false){?>
	    	<div class=""><?php echo Yii::t('app', 'Email-Adresse'); ?></div>
	    	<div class="requireditem input-container">
	    		<?=Html::textInput('UsersBase[fname]', $model->username  , ['type' => 'email' , 'title' => 'Bitte geben Sie ihre Vorname an!' . PHP_EOL . 'Vorname darf nur Buchstaben und mindestens 4 Buchstaben enthalten . Z.B. John']) ?>
	    	</div>
<?php } ?>	  
			<div class=""><?php echo Yii::t('app', 'Email-Adresse'); ?></div>  	
	    	<?= $form->field($model, 'username')->textInput(['autofocus' => true , 'type' => 'email' , 'class' => 'requireditem'
	    	])->label(false)->hint(false) ?>
	    	
	    	<div class=""><?php echo Yii::t('app', 'Passwort'); ?></div>
	    	<?=Html::passwordInput('LoginForm[password]', $model->password, ['class' => 'requireditem', 'id' => 'loginform-password']) ?>
			<p class="help-block help-block-error" style="color: #f94442;"><?php echo Yii::t('app', 'Benutzername oder Passwort fehlerhaft!'); ?></p>

	    </div>
    	
    	<div style="clear:both;"></div>
    </div>
  
  
    
	<div class="login-teil login-condition-teil">
		<div class="login-teil-title">
			<?php echo Yii::t('app', 'Sie haben noch kein Konto?'); ?> <br> 
			<a href="#" class="j2jgreentext" onclick="show_choose_register(this); return false;"> <?php echo Yii::t('app', 'Jetzt registrieren'); ?></a>
	    </div>
	 	<div class="login-teil-items-container"  style=" float: right; width: 50%;">
			
			<button type="submit" class="login-senden j2jgreenback"><?php echo Yii::t('app', 'Anmelden'); ?></button>
    		
    		<div class="login-abbrechen j2jgreenback" onclick="" style=" clear:both; width:100%;">
    				<?php echo Yii::t('app', 'Passwort vergessen'); ?>
    		</div>

	 	</div>
 	</div>   
 	    
    <?php ActiveForm::end() ?>
</div>

