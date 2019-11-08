<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $companyModel \common\lib\CompanyBase */
/* @var $pdmModel \common\lib\PersonaldecisionmakerBase */
/* @var $skills array */
/* @var $nationalities array */
/* @var $countries array */
/* @var $distances array */
/* @var $titles array */
/* @var $companytypes array */
/* @var $worktypes \common\lib\WorktimemodelBase */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\helper\BrainHelper;
use common\helper\BrainRadioBoxRenderer;
use common\helper\BrainCheckBoxBoxRenderer;

$this->registerCssFile("@web/web/css/regbewerbung.css", [], 'css-bewerbung');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerJsFile("@web/web/js/regunternehmen.js", [], 'js-bewerbung')

?>
<div class="register-bewerbung">
    
    <div class="register-bewerbung-title j2jblueback">
    	<?php echo Yii::t('app', 'Registrierung'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div style="clear:both;"></div>
    
    <?php $form = ActiveForm::begin(['id' => 'registerform'])?>
    <div class="register-bewerbung-teil register-bewerbung-personamgabe-teil">
	    
	    <div class="register-bewerbung-teil-items-container">

	    	<div class="item-title"><?php echo Yii::t('app', 'Vorname'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[fname]', $model->fname  , ['pattern' => '(?=.*[a-zA-Z]).{4,}' , 'title' => 'Bitte geben Sie ihre Vorname an!' . PHP_EOL . 'Vorname darf nur Buchstaben und mindestens 4 Buchstaben enthalten . Z.B. John']) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Nachname'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[lname]', $model->lname  , ['pattern' => '(?=.*[a-zA-Z]).{4,}' , 'title' => 'Bitte geben Sie ihre Nachname an!' . PHP_EOL . 'Nachname darf nur Buchstaben und mindestens 4 Buchstaben enthalten . Z.B. John']) ?>
	    	</div>
	    	<div style="clear: both; height: 20px;"></div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Firmenname'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('CompanyBase[companyname]', $companyModel->companyname  , ['pattern' => '(?=.*[a-zA-Z]).{4,}' , 'title' => 'Bitte geben Sie ihre Nachname an!' . PHP_EOL . 'Nachname darf nur Buchstaben und mindestens 4 Buchstaben enthalten . Z.B. John']) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[uname]', $model->uname , ['type' => 'email' , 'title' => 'Das E-Mail ist ungültig.\nBitte geben Sie ihr E-Mail an!']) ?>
	    	</div>


	    </div>
    	
    	<div style="clear:both;"></div>
    </div>
  
  
    
	<div class="register-bewerbung-teil register-bewerbung-condition-teil">
		<div class="register-bewerbung-teil-title">
			&nbsp;
	    </div>
	 	<div class="register-bewerbung-teil-items-container"  style=" clear:both; float: right; width: 50%;">
	    	<div class="item" style="border-left: 3px solid #a9cb14; height:55px; padding-left:5px; font-size:12px; margin-bottom: 20px;">
    			<input class="checkboxstyleone" type="checkbox" id="checkcondition" name="checkcondition" />
			    <label for="reachemail"><?php echo Yii::t('app', 'Ja, ich habe die <a href="#">Nutzungsbedingungen</a> gelesen und stimme diesen zu. Die <a href="#">Datenschutzerklärung</a> habe ich zur Kenntnis genommen.'); ?></label>
	    		<span class="checkone"><span class="inside"></span></span>

	    	</div>
    		<div class="register-bewerbung-senden j2jgreenback" onclick="submitregister();" style=" clear:both; width:100%;">
    				<?php echo Yii::t('app', 'REGISTRIEREN'); ?>
    		</div>
    		<div class="register-bewerbung-abbrechen j2jgreenback" onclick="clearregister();" style=" clear:both; width:100%;">
    				<?php echo Yii::t('app', 'Abbrechen & Daten löschen'); ?>
    		</div>
	    	
	    	
	 	    
	 	
	 	</div>
 	</div>   
 	    
    <?php ActiveForm::end() ?>
</div>

<?php $form = ActiveForm::begin(['id' => 'checkform' , 'action' => Yii::getAlias('@web/company/check')])?>
<input type="hidden" id="hdncheckmode" name="mode" />
<input type="hidden" id="hdncheckdata" name="data" />
<?php ActiveForm::end() ?>

<script>

	var fname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihre Vorname an!'); ?>";
	var lname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihre Nachname an!'); ?>";
	var fmname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Firmennamen an!'); ?>";
	var email_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihr E-Mail an!'); ?>";
	var email_invalid_msg = "<?php echo Yii::t('app', 'Das E-Mail ist ungültig.\nBitte geben Sie ihr E-Mail an!'); ?>";
	var email_exists_msg = "<?php echo Yii::t('app', 'Das E-Mail existiert in unserem Datenbank.\nBitte geben Sie anderes E-Mail an!'); ?>";
	var condition_msg = "<?php echo Yii::t('app', 'Bitte stimmen Sie die Nutzungsbedingungen und die Datenschutzerklärung!'); ?>";

	var basepath = "<?php echo Yii::getAlias('@web/candidate/'); ?>";
</script>
