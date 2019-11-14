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
<div class="register-bewerbung" ng-controller="NewPasswordController">
    
    <div class="register-bewerbung-title j2jbluebacktext">
    	<?php echo Yii::t('app', 'Neue Passwort'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    </div>
    
    <div style="clear:both;"></div>
    
    <?php $form = ActiveForm::begin(['id' => 'newpasswordform'])?>
    <input type="hidden" name="ac" value="vr" />
    <input type="hidden" name="ui" value="<?=$model->id ?>" />
    
    <div class="register-bewerbung-teil register-bewerbung-personamgabe-teil" style="border:none;">
	    
	    <div class="register-bewerbung-teil-items-container">

	    	<div class="item-title"><?php echo Yii::t('app', 'Kennwort'); ?></div>
	    	<div class="item requireditem">
				<?=Html::passwordInput('UsersBase[password_hash]', '' , ['required' => 'required', 'ng-model' => 'password', 'id' => 'password',  ]) ?>  	
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Kennwort bestätigen'); ?></div>
	    	<div class="item requireditem">
				<?=Html::passwordInput('', '' , ['required' => 'required', 'ng-model' => 'passwordconfirm', 'id' => 'confirm_password' , ]) ?>  	
	    	</div>

	    </div>
    	<div style="clear:both;"></div>
    	<div class="newpassword-senden-container" ">
			<button type="button" class="newpassword-senden j2jbluebacktext" ng-click="dosubmit()"><?php echo Yii::t('app', 'ÜBERPRÜFEN'); ?></button>
	 	</div>
	 	
    	
    	
    </div>
 	    
    <?php ActiveForm::end() ?>
</div>

<script>

	var password_format_msg = "<?php echo Yii::t('app', 'Kennwort Muss mindestens eine Zahl und einen Groß- und Kleinbuchstaben und mindestens 6 oder mehr Zeichen enthalten!'); ?>";	
	var password_confirm_msg = "<?php echo Yii::t('app', 'Die Passwörter stimmen nicht überein!'); ?>";
	
	var basepath = "<?php echo Yii::getAlias('@web/candidate/'); ?>";

</script>