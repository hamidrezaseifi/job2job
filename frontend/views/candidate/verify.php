<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $candidateModel \common\lib\CandidateBase */
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
$this->registerJsFile("@web/web/js/verifybewerbung.js", [], 'js-bewerbung');
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
    
    <div class="register-bewerbung-title j2jgreenback">
    	<?php echo Yii::t('app', 'Personaldaten Überprüfen'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div style="clear:both;"></div>
    
    <?php $form = ActiveForm::begin(['id' => 'verifyform'])?>
    <input type="hidden" name="ac" value="vr" />
    <input type="hidden" name="ui" value="<?=$candidateModel->userid ?>" />
    
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

	    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('CandidateBase[email]', $candidateModel->email , ['type' => 'email' , 'title' => 'Das E-Mail ist ungültig.\nBitte geben Sie ihr E-Mail an!']) ?>
	    	</div>

	    	<div class="item-title"><?php echo Yii::t('app', 'Geburtsdatum'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[bdate]', $model->bdate  , ['pattern' => '(?=.*[0-9]).{4,}' , 'title' => 'Bitte geben Sie ihr Geburtsdatum an!']) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Kennwort'); ?></div>
	    	<div class="item requireditem">
				<?=Html::passwordInput('UsersBase[password_hash]', '' , ['pattern' => '(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' , 'id' => 'password' ]) ?>  	
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Kennwort bestätigen'); ?></div>
	    	<div class="item requireditem">
				<?=Html::passwordInput('UsersBase[password_hash_verify]', '' , ['pattern' => '(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}' , 'id' => 'confirm_password' , 'pattern' => '(?=.*[a-zA-Z0-9]).{4,}' ]) ?>  	
	    	</div>

	    </div>
    	<div style="clear:both;"></div>
    	<div class="verify-bewerbung-senden j2jgreenback" onclick="submitverify();">
    		<?php echo Yii::t('app', 'ÜBERPRÜFEN'); ?>
    	</div>
    	
    	<div style="clear:both;"></div>
    	<?=Html::submitButton('Submit' , ['style' => 'display:none;' , 'id' => 'btnsubmit']) ?>
    </div>
 	    
    <?php ActiveForm::end() ?>
</div>

<?php $form = ActiveForm::begin(['id' => 'checkform' , 'action' => Yii::getAlias('@web/candidate/check')])?>
<input type="hidden" id="hdncheckmode" name="mode" />
<input type="hidden" id="hdncheckdata" name="data" />
<input type="hidden" id="hdncheckdata1" name="data1" value="<?=$candidateModel->userid ?>" />
<?php ActiveForm::end() ?>


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