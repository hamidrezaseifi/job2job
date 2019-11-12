<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->registerCssFile("@web/web/css/login.css", [], 'css-login');
$this->registerJsFile("@web/web/js/login.js", [], 'js-login');

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login" ng-controller="LoginController">
    
 
    <div class="content-center">
    			<div class="left-side-merkliste">
    				<div class="title-icon-seen" ><span class="vertical-align">IHRE VORTEILE MIT MEIN JOB2JOB</span></div>
    <p>Jetzt anmelden und Benachrichtigungen über neue Jobs erhalten, die Ihren Wunschkriterien entsprechen</p>

		<ul class="ul-iconseen-merkliste">
								
		     <li><span>Erhalten Sie regelmäßig Informationen zu den neuesten Jobangeboten in unserem Jobticker</span></li>
		     	
		 						
		     <li><span>Reichen Sie Ihren CV ein und nehmen Sie selbst Einfluss auf Ihr Bewerbungsverfahren</span></li>
		     	
		 						
		     <li><span>Erstellen Sie Ihre persönliche Merkliste mit für Sie interessanten Jobangeboten</span></li>
		     	
		 		</ul>
	

					
		</div>
		
		<div class="right-side-merkliste">
			<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
				<div class="response-errors">
					<div class="errormsg">Bitte füllen Sie alle gekennzeichneten Felder aus!</div>
					<div class="donemsg">Vielen Dank für Ihre Registrierung! Schauen Sie in Ihr Email Konto für die Bestätigung!</div>
					<div class="errorpassword">Passwort und/oder Nutzername falsch!</div>
				
				</div>	
	
				<div class="title">
										BEI MEIN JOB2JOB ANMELDEN
									</div>
				
				<div class="inputform">
					<label>E-Mail:</label>
					<?=$form->field($model, 'username')->textInput(['type' => 'email' , 'title' => 'Bitte geben Sie ihre Vorname an!' . PHP_EOL . 'Vorname darf nur Buchstaben und mindestens 4 Buchstaben enthalten . Z.B. John', 'autofocus' => true])->label(false);   ?>
				</div>
				
				<div class="inputform">
					<label>Passwort:</label>
					<?=$form->field($model, 'password')->passwordInput(['class' => 'requiredfield', 'id' => 'loginform-password'])->label(false) ?>
				</div>
				
				<div class="register-div">
					Neu bei Job2job? <a href="<?=Yii::getAlias('@web') ?>/site/register"> JETZT REGISTRIEREN</a>
					<a class="passreset-open"href="<?php echo Yii::getAlias('@web');?>/site/resetpassword">Passwort vergessen?</a>
				</div>
				
				<div class="button-form button-form-login-ajax" ng-click="doLogin()">ANMELDEN</div>
				<input type="submit" value="go" style="display:none;">
			<?php ActiveForm::end() ?>
		</div>		
	</div>    

</div>

