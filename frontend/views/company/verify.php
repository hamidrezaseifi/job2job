<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $companyModel \common\lib\CompanyBase */
/* @var $skills array */
/* @var $nationalities array */
/* @var $countries array */
/* @var $distances array */
/* @var $titles array */
/* @var $worktypes array */
/* @var $jobypes array */
/* @var $mode string */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerCssFile("@web/web/css/verifybewerbung.css", [], 'css-bewerbung');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerJsFile("@web/web/js/verifyunternehmen.js", [], 'js-verifyunternehmen');
//$skills
function render_skills($list , $ischild = false)
{
	if(count($list) == 0) return;
	echo '[';
	foreach ($list as $item)
	{
		echo '"' . $item['title'] . '" , ';
		render_skills($item['childs'] , true);
	}
	echo ']';
	echo ($ischild ? ',' : ';');
}
?>
<div class="register-bewerbung">
    
    <div class="register-bewerbung-title j2jbluebacktext">
    	<?php echo Yii::t('app', 'Personaldaten überprüfen'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div style="clear:both;"></div>
    
    <?php $form = ActiveForm::begin(['id' => 'verifyform'])?>
    <input type="hidden" name="ac" value="vr" />
    <input type="hidden" name="ui" value="<?=$model->id ?>" />
    <input type="hidden" name="ci" value="<?=$companyModel->id ?>" />
    
    <div class="register-bewerbung-teil register-bewerbung-personamgabe-teil">
	    
	    <div class="register-bewerbung-teil-items-container">

	    	<div class="item-title"><?php echo Yii::t('app', 'Firmenname'); ?></div>
	    	<div class="item requireditem">
	    		<input type="text" name="CompanyBase[companyname]" required value="<?php echo $companyModel->companyname;?>" />
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Gründungsdatum'); ?></div>
	    	<div class="item requireditem">
	    		<input type="text" value="<?php echo $companyModel->founddate;?>" required name="CompanyBase[founddate]" class="calender-icon" />
	    	</div>

	    	<div class="item-title"><?php echo Yii::t('app', 'Vorname'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[fname]', $model->fname  , ['pattern' => '(?=.*[a-zA-Z]).{4,}' , 'title' => 'Bitte geben Sie ihre Vorname an!' . PHP_EOL . 'Vorname darf nur Buchstaben und mindestens 4 Buchstaben enthalten . Z.B. John']) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Nachname'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[lname]', $model->lname  , ['pattern' => '(?=.*[a-zA-Z]).{4,}' , 'title' => 'Bitte geben Sie ihre Nachname an!' . PHP_EOL . 'Nachname darf nur Buchstaben und mindestens 4 Buchstaben enthalten . Z.B. John']) ?>
	    	</div>

	    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[uname]', $model->uname , ['type' => 'email' , 'title' => 'Das E-Mail ist ungültig.\nBitte geben Sie ihr E-Mail an!']) ?>
	    	</div>

	    </div>
    	<div style="clear:both;"></div>
    	<div class="verify-bewerbung-senden j2jbluebacktext" onclick="submitverify();">
    		<?php echo Yii::t('app', 'WEITER'); ?>
    	</div>
    	
    	<div style="clear:both;"></div>
    	<?=Html::submitButton('Submit' , ['style' => 'display:none;' , 'id' => 'btnsubmit']) ?>
    </div>
 	    
    <?php ActiveForm::end() ?>
</div>
<div class="clear"></div>
<?php $form = ActiveForm::begin(['id' => 'checkform' , 'action' => Yii::getAlias('@web/company/check')])?>
<input type="hidden" id="hdncheckmode" name="mode" />
<input type="hidden" id="hdncheckdata" name="data" />
<input type="hidden" id="hdncheckdata1" name="data1" value="<?=$model->id ?>" />
<?php ActiveForm::end() ?>


<script>

	var company_name_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Firmennamen an!'); ?>";
	var company_bdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie das Gründungsdatum der Firma an!'); ?>";
	var anrede_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie eine Anrede aus!'); ?>";
	var fname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie Ihren Vornamen an!'); ?>";
	var lname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie Ihren Nachnamen an!'); ?>";
	var bdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie Ihr Geburtsdatum an!'); ?>";
	var email_msg = "<?php echo Yii::t('app', 'Bitte geben Sie Ihre E-Mail-Adresse an!'); ?>";
	var email_invalid_msg = "<?php echo Yii::t('app', 'Die E-Mail-Adresse ist ungültig.\nBitte geben Sie eine gültige E-Mail an!'); ?>";
	var email_exists_msg = "<?php echo Yii::t('app', 'Die E-Mail existiert bereits.\nBitte geben Sie eine andere E-Mail-Adresse an!'); ?>";
	var password_format_msg = "<?php echo Yii::t('app', 'Das Kennwort muss mindestens eine Zahl, sowie einen Groß- und Kleinbuchstaben und mindestens 6 oder mehr Zeichen enthalten!'); ?>";	
	var password_confirm_msg = "<?php echo Yii::t('app', 'Die Passwörter stimmen nicht überein!'); ?>";
	
	var basepath = "<?php echo Yii::getAlias('@web/candidate/'); ?>";

</script>