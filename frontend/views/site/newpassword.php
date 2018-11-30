<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile("@web/web/css/verifybewerbung.css", [], 'css-bewerbung');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerJsFile("@web/web/js/newpassword.js", [], 'js-newpassword');
//$skills

?>
<div class="register-bewerbung">
    
    <div class="register-bewerbung-title j2jgreenback">
    	<?php echo Yii::t('app', 'Neue Passwort'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div style="clear:both;"></div>
    
    <?php $form = ActiveForm::begin(['id' => 'newpasswordform'])?>
    <input type="hidden" name="ac" value="vr" />
    <input type="hidden" name="ui" value="<?=$model->id ?>" />
    
    <div class="register-bewerbung-teil register-bewerbung-personamgabe-teil" style="border:none;">
	    
	    <div class="register-bewerbung-teil-items-container">

	    	<div class="item-title"><?php echo Yii::t('app', 'Kennwort'); ?></div>
	    	<div class="item requireditem">
				<?=Html::passwordInput('UsersBase[password_hash]', '' , ['required' => 'required', 'id' => 'password' , 'onchange' => '$("#confirm_password").prop("pattern" , this.value);',  ]) ?>  	
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Kennwort bestätigen'); ?></div>
	    	<div class="item requireditem">
				<?=Html::passwordInput('', '' , ['required' => 'required', 'pattern' => '' , 'id' => 'confirm_password' , ]) ?>  	
	    	</div>

	    </div>
    	<div style="clear:both;"></div>
    	<div class="register-bewerbung-teil-items-container"  style=" float: right; width: 50%; margin-top: 40px;">
			<button type="submit" class="newpassword-senden j2jgreenback"><?php echo Yii::t('app', 'ÜBERPRÜFEN'); ?></button>

	 	</div>
	 	
    	
    	
    </div>
 	    
    <?php ActiveForm::end() ?>
</div>

<script>

	var anrede_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie eine Anrede aus!'); ?>";
	var fname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihre Vorname an!'); ?>";
	var lname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihre Nachname an!'); ?>";
	var bdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihr Geburtsdatum an!'); ?>";
	var email_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihr E-Mail an!'); ?>";
	var email_invalid_msg = "<?php echo Yii::t('app', 'Das E-Mail ist ungültig.\nBitte geben Sie ihr E-Mail an!'); ?>";
	var email_exists_msg = "<?php echo Yii::t('app', 'Das E-Mail existiert in unserem Datenbank.\nBitte geben Sie anderes E-Mail an!'); ?>";
	var password_format_msg = "<?php echo Yii::t('app', 'Kennwort Muss mindestens eine Zahl und einen Groß- und Kleinbuchstaben und mindestens 6 oder mehr Zeichen enthalten!'); ?>";	
	var password_confirm_msg = "<?php echo Yii::t('app', 'Die Passwörter stimmen nicht überein!'); ?>";
	
	var basepath = "<?php echo Yii::getAlias('@web/candidate/'); ?>";

</script>