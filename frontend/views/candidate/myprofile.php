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

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\helper\BrainHelper;
use common\helper\BrainRadioBoxRenderer;
use common\helper\BrainCheckBoxBoxRenderer;

$this->registerCssFile("@web/web/css/profilebewerbung.css", [], 'css-bewerbung');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerJsFile("@web/web/js/profilebewerbung.js", [], 'js-bewerbung');
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
    	<?php echo Yii::t('app', 'Mein Profil'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div style="clear:both;"></div>
    
    <?php $form = ActiveForm::begin(['id' => 'registerform'])?>
    <div class="register-bewerbung-teil register-bewerbung-personamgabe-teil">
	    <div class="register-bewerbung-teil-title">
	    	<?php echo Yii::t('app', 'ANGABEN ZUR PERSON'); ?>
	    </div>
	    <div class="register-bewerbung-teil-items-container">
	    	
	    	<div class="item-title"><?php echo Yii::t('app', 'Anrede'); ?></div>
	    	<div class="item">
	    	<?= BrainRadioBoxRenderer::widget([
					'name' => 'CandidateBase[title]' , 
					'value' => $candidateModel->title , 
					'id_prefix' => 'title' , 
					'items' => array(Yii::t('app', 'Herr') => Yii::t('app', 'Herr') , Yii::t('app', 'Frau') => Yii::t('app', 'Frau')) , 
			]); ?>
			</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Titel'); ?></div>
	    	<div class="item">
	    	<?=Html::dropDownList('CandidateBase[title2]', $candidateModel->title2, $titles) ?>
	    	</div>

	    	<div class="item-title"><?php echo Yii::t('app', 'Vorname'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[fname]', $model->fname) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Nachname'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[lname]', $model->lname) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Geburtsdatum'); ?></div>
	    	<div class="item requireditem">
	    		<?=Html::textInput('UsersBase[bdate]', $model->bdate) ?>
	    	</div>

	    	<div class="item-title"><?php echo Yii::t('app', 'Staatsangehörigkeit'); ?></div>
	    	<div class="item">
	    	<?=Html::dropDownList('CandidateBase[nationality]', $candidateModel->nationality, $nationalities) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Bewerbungsfoto hochladen'); ?></div>
	    	<div class="item">
				<label class="fileContainer">
				     <?php echo Yii::t('app', 'Datei hochladen'); ?>
				    <input type="file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*, application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
				</label>	
				<div class="file_title"></div>    	
	    		
	    	</div>

	    </div>
    	
    	<div style="clear:both;"></div>
    </div>
  
    <div class="register-bewerbung-teil register-bewerbung-kontakt-teil">
	    <div class="register-bewerbung-teil-title">
	    	<?php echo Yii::t('app', 'KONTAKTDATEN'); ?>
	    </div>
	    <div class="register-bewerbung-teil-items-container">
	    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
	    	<div class="item requireditem">
	    		<input type="text" name="CandidateBase[email]" />
	    	</div>
	    	<div class="item-title">&nbsp;</div>
	    	<div class="item">&nbsp;</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Postleitzahl,Stadt'); ?></div>
	    	<div class="item">
	    		<input type="text" name="CandidateBase[pcode]" /><input type="text" name="CandidateBase[city]" />
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Land'); ?></div>
	    	<div class="item">
	    		<?=Html::dropDownList('CandidateBase[country]', $candidateModel->country, $countries) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Straße,Hausnummer'); ?></div>
	    	<div class="item">
	    		<input type="text" name="CandidateBase[address]" />
	    	</div>
	    	<div class="item-title">&nbsp;</div>
	    	<div class="item">&nbsp;</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Mobiltelefon'); ?></div>
	    	<div class="item">
	    		<input type="text" name="ctel1" /><input type="text" name="ctel2" /><input type="text" name="ctel3" />
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Festnetznummer'); ?></div>
	    	<div class="item">
	    		<input type="text" name="tel1" /><input type="text" name="tel2" /><input type="text" name="tel3" />
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Erreichbarkeit'); ?></div>
	    	<div class="item top-margin-15">
	    	<?=BrainCheckBoxBoxRenderer::widget([
					'name' => 'CandidateBase[reachability]' , 
					'value' => explode(',' , $candidateModel->reachability) , 
					'id_prefix' => 'reach' , 
					'items' => array(Yii::t('app', 'Telefon') => Yii::t('app', 'Telefon') , Yii::t('app', 'E-Mail') => Yii::t('app', 'E-Mail')) , 
			]) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Wann dürfen wir Sie kontaktieren?'); ?></div>
	    	<div class="item">
	    		<input type="text" name="CandidateBase[contacttime]" />
	    	</div>
	    </div>
    	
    	<div style="clear:both;"></div>
    </div>
    
    <div class="register-bewerbung-teil register-bewerbung-aktuellberuff-teil">
	    <div class="register-bewerbung-teil-title">
	    	<?php echo Yii::t('app', 'AKTUELLE BERUFLICHE SITUATION'); ?>
    	</div>
 	    <div class="register-bewerbung-teil-items-container">
	    	
	    	<div class="item-title"><?php echo Yii::t('app', 'Beschäftigung'); ?></div>
	    	<div class="item top-margin-15">
 	    <?= BrainRadioBoxRenderer::widget([
					'name' => 'CandidateBase[employment]' , 
					'value' => $candidateModel->employment , 
					'id_prefix' => 'employment' , 
					'items' => array(1 => Yii::t('app', 'Aktuell beschäftigt') , 0 => Yii::t('app', 'Aktuell nicht beschäftigt')) , 
			]); ?>
			</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Verfügbarkeit'); ?></div>
	    	<div class="item top-margin-15">
			<?= BrainRadioBoxRenderer::widget([
					'name' => 'CandidateBase[availability]' , 
					'value' => $candidateModel->availability , 
					'id_prefix' => 'available_' , 
					'items' => array(0 => Yii::t('app', 'Aktuell nicht verfügber') , 1 => Yii::t('app', 'Verfügber')) , 
			]); ?>
			</div>	    	
	    	<div class="item-title skillpart" ><?php echo Yii::t('app', 'Fähigkeiten'); ?></div>
	    	<div class="item skillpart" >
	    		<div id="skills" style="">
	    			<span class="brows-button"></span>
	    		</div>
	    	</div>
 
 		</div>   
    
    </div>
    
	<div class="register-bewerbung-teil register-bewerbung-beruffvorstellung-teil">
		<div class="register-bewerbung-teil-title">
			<?php echo Yii::t('app', 'BERUFLICHE VORSTELLUNG'); ?>
			<div class="anlagen-notiz"><?php echo Yii::t('app', 'Wo möchten Sie Ihre Tätigkeit ausführen?'); ?> </div>
	    </div>
	 	<div class="register-bewerbung-teil-items-container">
	    	<div class="item-title"><?php echo Yii::t('app', 'Postleitzahl,Stadt'); ?></div>
	    	<div class="item">
	    		<input type="text" name="CandidateBase[desiredjobpcode]" /><input type="text" name="CandidateBase[desiredjobcity]" />
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Land'); ?></div>
	    	<div class="item">
	    		<?=Html::dropDownList('CandidateBase[desiredjobcountry]', $candidateModel->country, $countries) ?>
	    	</div>
	    	<div class="item-title"><?php echo Yii::t('app', 'Umkreis'); ?></div>
	    	<div class="item">
	    		<?=Html::dropDownList('CandidateBase[desiredjobregion]', $candidateModel->desiredjobregion, $distances) ?>
	    	</div>
	    	
	 	
	 	</div>
 	</div>   
    
	<div class="register-bewerbung-teil register-bewerbung-anschreiben-teil">
		<div class="register-bewerbung-teil-title">
			<?php echo Yii::t('app', 'ANSCHREIBEN & ANLAGEN'); ?>
			<div class="anlagen-notiz"><?php echo Yii::t('app', 'Sie haben die möglichkeit Anschreiben, Lebensläufe, Zeugnisse und andere Anlagen anzuhängen. Die einzelnen Dateien dürfen 8 MB nicht überschreiten. Insgesamt düren maximal 20 MB hochgelagen werden. Erlaubte Dateiformate sind .pdf und .doc(.docx , .rtf).'); ?> </div>
	    </div>
	 	<div class="register-bewerbung-teil-items-container">
	    	<div class="item-title"><?php echo Yii::t('app', 'Anschreiben'); ?></div>
	    	<div class="item">
	    		<textarea name="CandidateBase[coverletter]" ></textarea>
	    	</div>
	    	<div class="item-title" style="margin-top:115px;"><?php echo Yii::t('app', 'Anlagen hinzufügen'); ?></div>
	    	<div class="item" style="margin-top:115px;">
	    		<label class="fileContainer">
				     <?php echo Yii::t('app', 'Datei hochladen'); ?>
				    <input type="file" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
text/plain, application/pdf, image/*, application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
				</label>	
				<div class="file_title"></div>    	
	    	</div>
	 	
	 	</div>
 	</div>   
    
	<div class="register-bewerbung-teil register-bewerbung-condition-teil">
		<div class="register-bewerbung-teil-title">
			&nbsp;
	    </div>
	 	<div class="register-bewerbung-teil-items-container">
	    	<div class="item-title">&nbsp;</div>
	    	<div class="item" style="border-left: 3px solid #a9cb14; height:55px; padding-left:5px; font-size:12px;">
    			<input class="checkboxstyleone" type="checkbox" id="checkcondition" name="checkcondition" />
			    <label for="reachemail"><?php echo Yii::t('app', 'Ja, ich habe die <a href="#">Nutzungsbedingungen</a> gelesen und stimme diesen zu. Die <a href="#">Datenschutzerklärung</a> habe ich zur Kenntnis genommen.'); ?></label>
	    		<span class="checkone"><span class="inside"></span></span>

	    	</div>
	    	<div class="item-title">&nbsp;</div>
	    	<div class="item" style="">
    			<div class="register-bewerbung-senden j2jgreenback" onclick="submitregister();">
    				<?php echo Yii::t('app', 'REGISTRIEREN'); ?>
    			</div>
    			<div class="register-bewerbung-abbrechen j2jgreenback" onclick="clearregister();">
    				<?php echo Yii::t('app', 'Abbrechen & Daten löschen'); ?>
    			</div>

	    	</div>
	    	
	 	    
	 	
	 	</div>
 	</div>   
 	    
    <?php ActiveForm::end() ?>
</div>

<?php $form = ActiveForm::begin(['id' => 'checkform' , 'action' => Yii::getAlias('@web/candidate/check')])?>
<input type="hidden" id="hdncheckmode" name="mode" />
<input type="hidden" id="hdncheckdata" name="data" />
<?php ActiveForm::end() ?>

<div id="skillbrowser" style="">
	<div class="skillbrowspannel">
		<div style="width: 100%;"> 
			<div class="skillbrowstitle"><?php echo Yii::t('app', 'Fähigkeit hinzufügen'); ?></div>
			<button id="closeskillbrows" style=""></button>
		</div>
		<div> 
			<input style="" id="skillbrowstext" >
			<button id="clearskillbrows" style=""></button>
		</div>
		<div style="clear: both;"></div>
		
		<div class="skillbrowsbottom">
			<button id="addskill" style=""><?php echo Yii::t('app', 'Hinzufügen'); ?></button>
		</div>
		
	</div>
</div>

<script>
	var availe_date_row = '<li id="availability_date_li" style="width: 130px; padding-left: 2px;"><?php echo Yii::t('app', 'Ab'); ?>&nbsp;<input type="text" name="CandidateBase[availablefrom]" value="<?=date('d.m.Y') ?>" /><span class="brows_date"></span></li>';

	var skills = <?php echo json_encode($skills);?>;
	var skills_title = <?php echo json_encode(array_values($skills) );?>;
	var skills_id = <?php echo json_encode(array_keys($skills) );?>;

	var anrede_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie eine Anrede aus!'); ?>";
	var fname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihre Vorname an!'); ?>";
	var lname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihre Nachname an!'); ?>";
	var bdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihr Geburtsdatum an!'); ?>";
	var email_msg = "<?php echo Yii::t('app', 'Bitte geben Sie ihr E-Mail an!'); ?>";
	var email_invalid_msg = "<?php echo Yii::t('app', 'Das E-Mail ist ungültig.\nBitte geben Sie ihr E-Mail an!'); ?>";
	var email_exists_msg = "<?php echo Yii::t('app', 'Das E-Mail existiert in unserem Datenbank.\nBitte geben Sie anderes E-Mail an!'); ?>";
	var curstatus_msg = "<?php echo Yii::t('app', 'Bitte erklären Sie ihre Beschäftigung!'); ?>";
	var avail_msg = "<?php echo Yii::t('app', 'Bitte erklären Sie ihre Verfügberkeit!'); ?>";
	var condition_msg = "<?php echo Yii::t('app', 'Bitte stimmen Sie die Nutzungsbedingungen und die Datenschutzerklärung!'); ?>";
	var skill_exists_msg = "<?php echo Yii::t('app', 'Fähigkeit existiert in der liste!'); ?>";

	var basepath = "<?php echo Yii::getAlias('@web/candidate/'); ?>";
	var skillurl = "<?php echo Yii::getAlias('@web/candidate/skills'); ?>";
</script>