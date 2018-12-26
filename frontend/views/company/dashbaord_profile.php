<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $modelSecond \common\models\Users */
/* @var $companyModel \common\lib\CompanyBase */
/* @var $pdmModel \common\lib\PersonaldecisionmakerBase */
/* @var $pdmModelSecond \common\lib\PersonaldecisionmakerBase */
/* @var $skills array */
/* @var $nationalities array */
/* @var $countries array */
/* @var $distances array */
/* @var $companytypes array */
/* @var $worktypes \common\lib\WorktimemodelBase */
/* @var $cellphoneList array */
/* @var $telList array */
/* @var $cellphoneList2 array */
/* @var $telList2 array */
/* @var $reachabilityList array */
/* @var $connectedCompanies array */

use yii\helpers\Html;
use common\helper\BrainRadioBoxRenderer;
use common\helper\BrainCheckBoxBoxRenderer;
use yii\bootstrap\ActiveForm;
use common\helper\BrainStaticList;

$this->registerCssFile("@web/web/css/profileunternehmen.css", [], 'css-profileunternehmen');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerJsFile("@web/web/js/profileunternehmen.js", [], 'js-profileunternehmen');

?>
<div class="register-bewerbung">
    
    <div class="register-bewerbung-title j2jgreenback">
    	<?php echo Yii::t('app', 'Mein Profil'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div class="register-bewerbung-teil register-unternehmen-personamgabe-teil">
	    <div class="register-bewerbung-teil-title">
	    	<?php echo Yii::t('app', 'ANGABEN ZUR FIRMA'); ?>
	    </div>
	    <div class="register-bewerbung-teil-items-container">
	    
	    	<div class="items-preview">
		    	<div class="item-title"><?php echo Yii::t('app', 'Geschäftsform'); ?></div>
		    	<div class="item "> <?=$companytypes[$companyModel->companytype] ?> </div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Verbundene Unternehmen'); ?></div>
		    	<div class="item top-margin-15">
		    		<?= (count($connectedCompanies) == 0 ? Yii::t('app', 'Kein'): implode(', ', $connectedCompanies)) ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Firmenname'); ?></div>
		    	<div class="item "> <?php echo $companyModel->companyname;?> </div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Gründungsdatum'); ?></div>
		    	<div class="item "><?php echo $companyModel->founddate;?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Steuer-ID'); ?></div>
		    	<div class="item "><?php echo $companyModel->taxid;?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Homepage'); ?></div>
		    	<div class="item "><?php echo $companyModel->homepage;?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Anzahl der Mitarbeiter'); ?></div>
		    	<div class="item  top-margin-15"> <?= $employeecountList[$companyModel->employeecountindex]; ?> </div>
		    	<div class="item-title" style="line-height: 80px;"><?php echo Yii::t('app', 'Logo'); ?></div>
		    	<div class="item <?=($photo_approved ? '' : 'notapprovedparent')?>" style="line-height: 80px;"><?=($photopath ? '<img src="' . $photopath . '" class="personalphoto3 ' . ($photo_approved ? '' : 'notapproved') . '" >' : '-') ?></div>	  
	    	
	    	</div>
	    	
	    	<div class="items-edit">
	    	<?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data']])?>
	    		<input type="hidden" name="part" value="company">
	    		<input type="hidden" name="MAX_FILE_SIZE" value="2242880" />
		    	<div class="item-title"><?php echo Yii::t('app', 'Geschäftsform'); ?></div>
		    	<div class="item requireditem">
					<?=Html::dropDownList('CompanyBase[companytype]', $companyModel->companytype, $companytypes) ?>
		    	</div>
		    	<div class="item-title skillpart"><?php echo Yii::t('app', 'Verbundene Unternehmen'); ?></div>
		    	<div class="item top-margin-15 skillpart" style="height:80px;">
		    		<div id="skills" style="">
		    			<span class="brows-button"></span>
		    		</div>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Firmenname'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="CompanyBase[companyname]" required value="<?php echo $companyModel->companyname;?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Gründungsdatum'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" value="<?php echo $companyModel->founddate;?>" required name="CompanyBase[founddate]" style="position: relative; z-index: 100;" class="calender-icon" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Steuer-ID'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="CompanyBase[taxid]" required value="<?php echo $companyModel->taxid;?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Homepage'); ?></div>
		    	<div class="item">
		    		<input type="text" name="CompanyBase[homepage]" value="<?php echo $companyModel->homepage;?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Anzahl der Mitarbeiter'); ?></div>
		    	<div class="item top-margin-15">
		    	<?= BrainRadioBoxRenderer::widget([
						'name' => 'CompanyBase[employeecountindex]' , 
		    			'value' => $companyModel->employeecountindex, 
						'id_prefix' => 'employeecount' , 
		    			'items' => $employeecountList, 
				]); ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Logo hochladen'); ?></div>
		    	<div class="item">
					<label class="fileContainer">
					     <?php echo Yii::t('app', 'Datei hochladen'); ?>
					    <input type="file" accept="image/*" name="company_logo" id="company_logo" multiple />
					</label>	
					<div class="file_title"></div>    	
		    	</div>
		    	<div style="clear:both; "></div> 
		    	<?php ActiveForm::end() ?>   	
	    	
	    	</div>

			<div class="items-edit-preview-part">
				<div class="applyedit" title="<?php echo Yii::t('app', 'übernehmen'); ?>">&nbsp;</div>
				<div class="showedit" title="<?php echo Yii::t('app', 'Bearbeiten'); ?>">&nbsp;</div>
				<div class="hideedit" title="<?php echo Yii::t('app', 'abbrechen'); ?>">&nbsp;</div>
			</div>
	    	
	    </div>
    	    	
    	<div class="open-close-button">
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_down.png" class="imgopen" style="width:20px;" />
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_up.png" class="imgclose" style="width:20px; display:none;" />
    	</div>
    	<div style="clear:both; "></div>
    </div>
 
    <div class="register-bewerbung-teil register-unternehmen-kontakt-teil">
	    <div class="register-bewerbung-teil-title">
	    	<div><?php echo Yii::t('app', 'PET(Personalentscheider)'); ?></div>
	    	
	   	</div>
	    <div class="register-bewerbung-teil-items-container">
	    
	    	<div class="items-preview">
	    
		    	<div class="item-title"><?php echo Yii::t('app', 'Anrede'); ?></div>
		    	<div class="item "> <?= $pdmModel->title  ?> </div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Vorname'); ?></div>
		    	<div class="item "><?php echo $model->fname;?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Nachname'); ?></div>
		    	<div class="item "><?php echo $model->lname;?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Geburtsdatum'); ?></div>
		    	<div class="item "><?php echo $model->bdate;?></div>
		    
		    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
		    	<div class="item "><?php echo $model->uname;?></div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Mobiltelefon'); ?></div>
		    	<div class="item"><?=$cellphoneList[0] ?> - <?=$cellphoneList[1] ?> - <?=$cellphoneList[2] ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Festnetznummer'); ?></div>
		    	<div class="item"><?=$telList[0] ?> - <?=$telList[1] ?> - <?=$telList[2] ?> </div>
		    	<div class="item-title" style="margin-top:15px;"><?php echo Yii::t('app', 'Erreichbarkeit'); ?></div>
		    	<div class="item" style="margin-top:15px;"><?=$pdmModel->reachability?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Wann dürfen wir Sie kontaktieren?'); ?></div>
		    	<div class="item"><?php echo $pdmModel->contacttime;?></div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	
		    	<div class="item-title" style="margin-top:15px;"><?php echo Yii::t('app', 'Stellvertreter'); ?></div>
		    	<div class="item" style="margin-top:15px;"> <?=($pdmModelSecond->isNewRecord ? Yii::t('app', 'nicht eingestellt'): '')?> </div>
		    	<?php if(!$pdmModelSecond->isNewRecord) {?>
		    	<div class="item-title stelcertreter nodisplay top-margin-15"><?php echo Yii::t('app', 'S. Anrede'); ?></div>
		    	<div class="item  stelcertreter nodisplay top-margin-15"><?= $pdmModelSecond->title ?></div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Vorname'); ?></div>
		    	<div class="item  stelcertreter nodisplay"><?php echo $modelSecond->fname;?></div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Nachname'); ?></div>
		    	<div class="item  stelcertreter nodisplay"><?php echo $modelSecond->lname;?></div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Geburtsdatum'); ?></div>
		    	<div class="item  stelcertreter nodisplay"><?php echo $modelSecond->bdate;?></div>
		    
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. E-Mail'); ?></div>
		    	<div class="item requireditem stelcertreter nodisplay"><?php echo $modelSecond->uname;?></div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Mobiltelefon'); ?></div>
		    	<div class="item stelcertreter nodisplay"> <?=$cellphoneList2[0] ?> - <?=$cellphoneList2[1] ?> - <?=$cellphoneList2[2] ?> </div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Festnetznummer'); ?></div>
		    	<div class="item stelcertreter nodisplay"> <?=$telList2[0] ?> - <?=$telList2[1] ?> - <?=$telList2[2] ?> </div>
		    	<div class="item-title stelcertreter nodisplay" style="margin-top:15px;"><?php echo Yii::t('app', 'S. Erreichbarkeit'); ?></div>
		    	<div class="item stelcertreter nodisplay" style="margin-top:15px;"> <?=$pdmModelSecond->reachability?> </div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Wann dürfen wir Sie kontaktieren?'); ?></div>
		    	<div class="item stelcertreter nodisplay"><?php echo $pdmModelSecond->contacttime;?></div>
				<?php } ?>
	    	</div>
	    	
	    
	    	<div class="items-edit">
	    
	    	<?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data']])?>
	    		<input type="hidden" name="part" value="contact">
	    		<input type="hidden" name="MAX_FILE_SIZE" value="2242880" />
		    	<div class="item-title"><?php echo Yii::t('app', 'Anrede'); ?></div>
		    	<div class="item requireditem top-margin-15">
		    	<?= BrainRadioBoxRenderer::widget([
						'name' => 'PersonaldecisionmakerBase[title]' , 
						'value' => $pdmModel->title , 
						'id_prefix' => 'title' , 
		    			'items' => BrainStaticList::titleList(false), 
				]); ?>
		    		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Vorname'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="UsersBase[fname]" required value="<?php echo $model->fname;?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Nachname'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="UsersBase[lname]" required value="<?php echo $model->lname;?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Geburtsdatum'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="UsersBase[bdate]" style="position: relative; z-index: 100;" required value="<?php echo $model->bdate;?>" class="calender-icon" />
		    	</div>
		    
		    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="UsersBase[uname]" required value="<?php echo $model->uname;?>" />
		    	</div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Mobiltelefon'); ?></div>
		    	<div class="item">
		    		<input type="text" name="ctel1" value="<?=$cellphoneList[0] ?>" /><input type="text" name="ctel2" value="<?=$cellphoneList[1] ?>" /><input type="text" name="ctel3" value="<?=$cellphoneList[2] ?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Festnetznummer'); ?></div>
		    	<div class="item">
		    		<input type="text" name="tel1" value="<?=$telList[0] ?>" /><input type="text" name="tel2" value="<?=$telList[1] ?>" /><input type="text" name="tel3" value="<?=$telList[2] ?>" />
		    	</div>
		    	<div class="item-title" style="margin-top:15px;"><?php echo Yii::t('app', 'Erreichbarkeit'); ?></div>
		    	<div class="item" style="margin-top:15px;">
				    	<?=BrainCheckBoxBoxRenderer::widget([
								'name' => 'reachability' , 
				    			'value' => array_map('trim' , explode(',' , $pdmModel->reachability)) , 
								'id_prefix' => 'reach' , 
								'items' => $reachabilityList , 
						]) ?>
		    	
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Wann dürfen wir Sie kontaktieren?'); ?></div>
		    	<div class="item">
		    		<input type="text" name="PersonaldecisionmakerBase[contacttime]" value="<?php echo $pdmModel->contacttime;?>" />
		    	</div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	
		    	<div class="item-title" style="margin-top:15px;"><?php echo Yii::t('app', 'Stellvertreter'); ?></div>
		    	<div class="item" style="margin-top:15px;">
		    	<?=BrainCheckBoxBoxRenderer::widget([
						'name' => 'SecondPersonaldecisionmaker' , 
		    			'value' => ($pdmModelSecond->isNewRecord ? array() : array(0)) , 
						'id_prefix' => 'stellvertreter' , 
						'items' => array(0 => Yii::t('app', '')) , 
				]) ?>
		    	</div>
		    	
		    	<div class="item-title stelcertreter nodisplay top-margin-15"><?php echo Yii::t('app', 'S. Anrede'); ?></div>
		    	<div class="item requireditem stelcertreter nodisplay top-margin-15">
		    	<?= BrainRadioBoxRenderer::widget([
						'name' => 'PersonaldecisionmakerBaseSV[title]' , 
		    			'value' => $pdmModelSecond->title , 
						'id_prefix' => 'titleSV' , 
		    			'items' => BrainStaticList::titleList(false), 
				]); ?>
		    		    	</div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Vorname'); ?></div>
		    	<div class="item requireditem stelcertreter nodisplay">
		    		<input type="text" name="UsersBaseSV[fname]" required value="<?php echo $modelSecond->fname;?>" />
		    	</div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Nachname'); ?></div>
		    	<div class="item requireditem stelcertreter nodisplay">
		    		<input type="text" name="UsersBaseSV[lname]" required value="<?php echo $modelSecond->lname;?>" />
		    	</div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Geburtsdatum'); ?></div>
		    	<div class="item requireditem stelcertreter nodisplay">
		    		<input type="text" name="UsersBaseSV[bdate]" style="position: relative; z-index: 100;" required value="<?php echo $modelSecond->bdate;?>" class="calender-icon" />
		    	</div>
		    
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. E-Mail'); ?></div>
		    	<div class="item requireditem stelcertreter nodisplay">
		    		<input type="text" name="UsersBaseSV[uname]" required value="<?php echo $modelSecond->uname;?>" />
		    	</div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Mobiltelefon'); ?></div>
		    	<div class="item stelcertreter nodisplay">
		    		<input type="text" name="ctel1SV" value="<?=$cellphoneList2[0] ?>" /><input type="text" name="ctel2SV" value="<?=$cellphoneList2[1] ?>" /><input type="text" name="ctel3SV" value="<?=$cellphoneList2[2] ?>" />
		    	</div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Festnetznummer'); ?></div>
		    	<div class="item stelcertreter nodisplay">
		    		<input type="text" name="tel1SV" value="<?=$telList2[0] ?>" /><input type="text" name="tel2SV" value="<?=$telList2[1] ?>" /><input type="text" name="tel3SV" value="<?=$telList2[2] ?>" />
		    	</div>
		    	<div class="item-title stelcertreter nodisplay" style="margin-top:15px;"><?php echo Yii::t('app', 'S. Erreichbarkeit'); ?></div>
		    	<div class="item stelcertreter nodisplay" style="margin-top:15px;">
		    	<?=BrainCheckBoxBoxRenderer::widget([
		    			'name' => 'reachabilitySV' ,
		    			'value' => array_map('trim' , explode(',' , $pdmModelSecond->reachability)) ,
		    			'id_prefix' => 'reachSV' ,
		    			'items' => $reachabilityList ,
		    	]) ?>
		    	
		    	</div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Wann dürfen wir Sie kontaktieren?'); ?></div>
		    	<div class="item stelcertreter nodisplay">
		    		<input type="text" name="PersonaldecisionmakerBaseSV[contacttime]" value="<?php echo $pdmModelSecond->contacttime;?>" />
		    	</div>
		    	<div style="clear:both; "></div> 
		    	<?php ActiveForm::end() ?>   	

	    	</div>
	    		 
	    		    	
			<div class="items-edit-preview-part">
				<div class="applyedit" title="<?php echo Yii::t('app', 'übernehmen'); ?>">&nbsp;</div>
				<div class="showedit" title="<?php echo Yii::t('app', 'Bearbeiten'); ?>">&nbsp;</div>
				<div class="hideedit" title="<?php echo Yii::t('app', 'abbrechen'); ?>">&nbsp;</div>
			</div>
	    		    	
	    </div>
    	    	
    	<div class="open-close-button">
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_down.png" class="imgopen" style="width:20px;" />
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_up.png" class="imgclose" style="width:20px; display:none;" />
    	</div>
    	<div style="clear:both; "></div>
    </div>
     
</div>

<div id="newcompany" style="">
	<div class="skillbrowspannel">
		<div style="width: 100%;"> 
			<div class="skillbrowstitle"><?php echo Yii::t('app', 'Verbindete Firma hinzufügen'); ?></div>
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

<script type="text/javascript">
var company_name_msg = "<?php echo Yii::t('app', 'Bitte geben Sie die Vorname der Firma an!'); ?>";
var company_bdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie das Gründungsdatum der Firma an!'); ?>";
var company_taxid_msg = "<?php echo Yii::t('app', 'Bitte geben Sie das Steuer-ID der Firma an!'); ?>";
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

var anrede_sv_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie eine Anrede für den Stellvertreter aus!'); ?>";
var fname_sv_msg = "<?php echo Yii::t('app', 'Bitte geben Sie die Vorname des Stellvertreters an!'); ?>";
var lname_sv_msg = "<?php echo Yii::t('app', 'Bitte geben Sie die Nachname des Stellvertreters an!'); ?>";
var bdate_sv_msg = "<?php echo Yii::t('app', 'Bitte geben Sie das Geburtsdatum des Stellvertreters an!'); ?>";
var email_sv_msg = "<?php echo Yii::t('app', 'Bitte geben Sie das E-Mail des Stellvertreters an!'); ?>";
var email_sv_invalid_msg = "<?php echo Yii::t('app', 'Das E-Mail für den Stellvertreter ist ungültig.\nBitte geben Sie das E-Mail des Stellvertreters an!'); ?>";


$(document).ready(function(){
	<?php foreach($connectedCompanies as $skill){?>
	add_skill("<?php echo $skill; ?>");
	<?php } ?>

});

</script>
