<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $candidateModel \common\models\CandidateBase */
/* @var $skills array */
/* @var $allskills array */
/* @var $nationalities array */
/* @var $countries array */
/* @var $distances array */
/* @var $worktypes array */
/* @var $jobypes array */
/* @var $reachabilityList array */
/* @var $cities array */
/* @var $postcodes array */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\helper\BrainHelper;
use common\helper\BrainRadioBoxRenderer;
use common\helper\BrainCheckBoxBoxRenderer;
use common\helper\BrainStaticList;

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
<div class="register-bewerbung" ng-controller="CandidateContentController">
    
    <div class="register-bewerbung-title j2jgreenback">
    	<?php echo Yii::t('app', 'Mein Profil'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jgreenback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div style="clear:both;"></div>
    
    
    <div class="register-bewerbung-teil register-bewerbung-personamgabe-teil">
	    <div class="register-bewerbung-teil-title">
	    	<?php echo Yii::t('app', 'ANGABEN ZUR PERSON'); ?>
	    </div>
	    <div class="register-bewerbung-teil-items-container">
	    	
	    	<div class="items-preview">
		    	<div class="item-title"><?php echo Yii::t('app', 'Anrede'); ?></div>
		    	<div class="item"><?=$candidateModel->title ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Titel'); ?></div>
		    	<div class="item"> <?=$candidateModel->title2 ?> </div>
	
		    	<div class="item-title"><?php echo Yii::t('app', 'Vorname'); ?></div>
		    	<div class="item requireditem">
		    		<?=$model->fname ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Nachname'); ?></div>
		    	<div class="item requireditem">
		    		<?=$model->lname ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Geburtsdatum'); ?></div>
		    	<div class="item requireditem">
		    		<?=$model->bdate ?>
		    	</div>
	
		    	<div class="item-title"><?php echo Yii::t('app', 'Staatsangehörigkeit'); ?></div>
		    	<div class="item">
		    	<?=$candidateModel->nationality ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Bewerbungsfoto'); ?></div>
		    	<div class="item"><?=($photopath ? '<img src="' . $photopath . '" class="personalphoto2 ' . ($photo_approved ? '' : 'notapproved') . '" >' : '-') . ($photo_approved ? '' : ' &nbsp; &nbsp;' . Yii::t('app', 'nicht bestätigt')) ?></div>	  
		    	<div style="clear:both; "></div>  	
	    	</div>
			
	    	<div class="items-edit">
	    	<?php $form = ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data']])?>
	    		<input type="hidden" name="part" value="person">
	    		<input type="hidden" name="MAX_FILE_SIZE" value="2242880" />
		    	<div class="item-title"><?php echo Yii::t('app', 'Anrede'); ?></div>
		    	<div class="item">
		    	<?= BrainRadioBoxRenderer::widget([
						'name' => 'CandidateBase[title]' , 
						'value' => $candidateModel->title , 
						'id_prefix' => 'title' , 
						'items' => BrainStaticList::titleList(false) , 
				]); ?>
				</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Titel'); ?></div>
		    	<div class="item">
		    	<?=Html::dropDownList('CandidateBase[title2]', $candidateModel->title2, BrainStaticList::title2List()) ?>
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
					    <input type="file" accept="image/*" name="candidate_photo" id="candidate_photo" file-model="candidate_photo" multiple />
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
  
    <div class="register-bewerbung-teil register-bewerbung-kontakt-teil">
	    <div class="register-bewerbung-teil-title">
	    	<?php echo Yii::t('app', 'KONTAKTDATEN'); ?>
	    </div>
	    <div class="register-bewerbung-teil-items-container">
	    	<div class="items-edit">
		    	<?php $form = ActiveForm::begin([])?>
		    	<input type="hidden" name="part" value="contact">
		    
		    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="CandidateBase[email]" value="<?=$candidateModel->email ?>"/>
		    	</div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Postleitzahl,Stadt'); ?></div>
		    	<div class="item">
		    		<input type="text" name="CandidateBase[pcode]" value="<?=$candidateModel->pcode ?>" /><input readonly type="text" name="CandidateBase[city]" value="<?=$candidateModel->city ?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Land'); ?></div>
		    	<div class="item">
		    		<?=Html::dropDownList('CandidateBase[country]', $candidateModel->country, $countries) ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Straße,Hausnummer'); ?></div>
		    	<div class="item">
		    		<input type="text" name="CandidateBase[address]" value="<?=$candidateModel->address ?>" />
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
		    	<div class="item-title"><?php echo $model->attributeLabels()['receive_backend_email']; ?></div>
		    	<div class="item top-margin-15">
		    		<?= BrainRadioBoxRenderer::widget([
						'name' => 'UsersBase[receive_backend_email]' , 
						'value' => $model->receive_backend_email , 
						'id_prefix' => 'receive-email' , 
						'items' => BrainStaticList::janeinList(false) , 
				]); ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Erreichbarkeit'); ?></div>
		    	<div class="item top-margin-15">
		    	<?=BrainCheckBoxBoxRenderer::widget([
						'name' => 'reachability' , 
						'value' => array_map('trim' , explode(',' , $candidateModel->reachability)) , 
						'id_prefix' => 'reach' , 
						'items' => $reachabilityList , 
				]) ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Wann dürfen wir Sie kontaktieren?'); ?></div>
		    	<div class="item">
		    		<input type="text" name="CandidateBase[contacttime]" value="<?=$candidateModel->contacttime ?>" />
		    	</div>
		    	<?php ActiveForm::end();?>
		    	<div style="clear:both;"></div>
		    </div>

	    	<div class="items-preview">
		    
		    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
		    	<div class="item "> <?=$candidateModel->email ?></div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Postleitzahl,Stadt'); ?></div>
		    	<div class="item"><?=($candidateModel->pcode . ' ' . $candidateModel->city) ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Land'); ?></div>
		    	<div class="item"><?=$candidateModel->country ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Straße,Hausnummer'); ?></div>
		    	<div class="item"><?=($candidateModel->address) ?></div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Mobiltelefon'); ?></div>
		    	<div class="item"><?=($candidateModel->cellphone) ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Festnetznummer'); ?></div>
		    	<div class="item"><?=($candidateModel->tel) ?></div>
		    	<div class="item-title"><?php echo $model->attributeLabels()['receive_backend_email']; ?></div>
		    	<div class="item"><?=($model->receive_backend_email == 1 ? Yii::t('app', 'Ja') : Yii::t('app', 'Nein')) ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Erreichbarkeit'); ?></div>
		    	<div class="item top-margin-15"><?=($candidateModel->reachability) ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Wann dürfen wir Sie kontaktieren?'); ?></div>
		    	<div class="item"><?=($candidateModel->contacttime) ?></div>
		    	<div style="clear:both;"></div>
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
    	
    	<div style="clear:both;"></div>
    </div>
    
    <div class="register-bewerbung-teil register-bewerbung-aktuellberuff-teil">
	    <div class="register-bewerbung-teil-title">
	    	<?php echo Yii::t('app', 'AKTUELLE BERUFLICHE SITUATION'); ?>
    	</div>
 	    <div class="register-bewerbung-teil-items-container">
	    	
	    	<div class="items-edit">
		    	<?php $form = ActiveForm::begin([])?>
		    	<input type="hidden" name="part" value="cur-job-situation">
	    	
		    	<div class="item-title"><?php echo Yii::t('app', 'Beschäftigung'); ?></div>
		    	<div class="item top-margin-15">
	 	    <?= BrainRadioBoxRenderer::widget([
						'name' => 'CandidateBase[employment]' , 
						'value' => $candidateModel->employment , 
						'id_prefix' => 'employment' , 
						'items' => BrainStaticList::employeementList() , 
				]); ?>
				</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Verfügbarkeit'); ?></div>
		    	<div class="item top-margin-15">
				<?= BrainRadioBoxRenderer::widget([
						'name' => 'CandidateBase[availability]' , 
						'value' => $candidateModel->availability , 
						'id_prefix' => 'available_' , 
						'items' => BrainStaticList::accessableList() , 
				]); ?>
				</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Job-Sorte'); ?></div>
		    	<div class="item top-margin-15">
				<?= BrainRadioBoxRenderer::widget([
						'name' => 'CandidateBase[jobtype]' , 
						'value' => $candidateModel->jobtype , 
						'id_prefix' => 'jobtype_' , 
						'items' => $jobypes , 
				]); ?>
		    	</div>
		    	
		    	<div class="item-title skillpart <?=($candidateModel->jobtype == '' ? ' nodisplay' : '') ?>" ><?php echo Yii::t('app', 'Fähigkeiten'); ?></div>
		    	<div class="item skillpart <?=($candidateModel->jobtype == '' ? ' nodisplay' : '') ?>" >
		    		<div id="skills" style="">
		    			<span class="brows-button" ng-click="browsskills()"></span>
		    		</div>
		    	</div>
		    	<div style="clear:both;"></div>
 				<?php ActiveForm::end()?>
 			</div>   

	    	<div class="items-preview">
	    	
		    	<div class="item-title"><?php echo Yii::t('app', 'Beschäftigung'); ?></div>
		    	<div class="item top-margin-15">
	 	    <?= BrainStaticList::employeementList()[$candidateModel->employment] ?>
				</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Verfügbarkeit'); ?></div>
		    	<div class="item top-margin-15">
				<?= $candidateModel->availability; ?>
				</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Job-Sorte'); ?></div>
		    	<div class="item top-margin-15">
				<?=($candidateModel->jobtype != null ? $jobypes[$candidateModel->jobtype] : '') ?>
		    	</div>
		    	
		    	<div class="item-title skillpart <?=($candidateModel->jobtype == '' ? ' nodisplay' : '') ?>" ><?php echo Yii::t('app', 'Fähigkeiten'); ?></div>
		    	<div class="item skillpart <?=($candidateModel->jobtype == '' ? ' nodisplay' : '') ?>" >
		    	<?php foreach($skills as $skill){?>
					<span class="skillitempreview"><?php echo $skill  . ', '; ?></span>
				<?php } ?>
		    		
		    	</div>
		    	<div style="clear:both;"></div>
 			</div>   
			
			<div class="items-edit-preview-part" style="margin-top: 40px;">
				<div class="applyedit" title="<?php echo Yii::t('app', 'übernehmen'); ?>">&nbsp;</div>
				<div class="showedit" title="<?php echo Yii::t('app', 'Bearbeiten'); ?>">&nbsp;</div>
				<div class="hideedit" title="<?php echo Yii::t('app', 'abbrechen'); ?>">&nbsp;</div>
			</div>
 			
 		</div>   
    	
    	<div class="open-close-button">
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_down.png" class="imgopen" style="width:20px;" />
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_up.png" class="imgclose" style="width:20px; display:none;" />
    	</div>
    	
    	<div style="clear:both;"></div>
    
    </div>
    
	<div class="register-bewerbung-teil register-bewerbung-beruffvorstellung-teil">
		<div class="register-bewerbung-teil-title">
			<?php echo Yii::t('app', 'BERUFLICHE VORSTELLUNG'); ?>
			<div class="anlagen-notiz"><?php echo Yii::t('app', 'Wo möchten Sie Ihre Tätigkeit ausführen?'); ?> </div>
	    </div>
	 	<div class="register-bewerbung-teil-items-container">
	 	
	    	<div class="items-edit">
		    	<?php $form = ActiveForm::begin([])?>
		    	<input type="hidden" name="part" value="job-vision">
		    	<div class="item-title"><?php echo Yii::t('app', 'Postleitzahl,Stadt'); ?></div>
		    	<div class="item">
		    		<input type="text" name="CandidateBase[desiredjobpcode]" value="<?=$candidateModel->desiredjobpcode ?>" /><input type="text" readonly name="CandidateBase[desiredjobcity]" value="<?=$candidateModel->desiredjobcity ?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Land'); ?></div>
		    	<div class="item">
		    		<?=Html::dropDownList('CandidateBase[desiredjobcountry]', $candidateModel->desiredjobcountry, $countries) ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Umkreis'); ?></div>
		    	<div class="item">
		    		<?=Html::dropDownList('CandidateBase[desiredjobregion]', $candidateModel->desiredjobregion, $distances) ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Arbeitszeitmodel'); ?></div>
		    	<div class="item">
		    		<?=Html::dropDownList('CandidateBase[desiredjobtimetype]', $candidateModel->desiredjobtimetype, $worktypes) ?>
		    	</div>
		    	<div style="clear:both;"></div>
 				<?php ActiveForm::end()?>
	    	</div>
	 	
	    	<div class="items-preview">
		    	<div class="item-title"><?php echo Yii::t('app', 'Postleitzahl,Stadt'); ?></div>
		    	<div class="item"><?=($candidateModel->desiredjobpcode . ' ' . $candidateModel->desiredjobcity) ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Land'); ?></div>
		    	<div class="item"><?=($candidateModel->desiredjobcountry != null ? $countries[$candidateModel->desiredjobcountry] : '') ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Umkreis'); ?></div>
		    	<div class="item"><?=($candidateModel->desiredjobregion != null ? $distances[$candidateModel->desiredjobregion] : '') ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Arbeitszeitmodel'); ?></div>
		    	<div class="item"><?=($candidateModel->desiredjobtimetype!= null ? $worktypes[$candidateModel->desiredjobtimetype] : '') ?></div>
		    	<div style="clear:both;"></div>
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
    	
    	<div style="clear:both;"></div>
 	</div>   
    
	<div class="register-bewerbung-teil register-bewerbung-anschreiben-teil">
		<div class="register-bewerbung-teil-title">
			<?php echo Yii::t('app', 'ANSCHREIBEN & ANLAGEN'); ?>
			<div class="anlagen-notiz"><?php echo Yii::t('app', 'Sie haben die möglichkeit Anschreiben, Lebensläufe, Zeugnisse und andere Anlagen anzuhängen. Die einzelnen Dateien dürfen 8 MB nicht überschreiten. Insgesamt düren maximal 20 MB hochgelagen werden. Erlaubte Dateiformate sind .pdf und .doc(.docx , .rtf).'); ?> </div>
	    </div>
	 	<div class="register-bewerbung-teil-items-container">
		    	
	    	<div class="items-preview" style="height: 130px;">
		    	<div class="item-title"><?php echo Yii::t('app', 'Anschreiben'); ?></div>
		    	<div class="item" style="height: inherit;"><?=nl2br($candidateModel->coverletter) ?></div>

		    	<div class="item-title" style=";"><?php echo Yii::t('app', 'Anlagen hinzufügen'); ?></div>
		    	<div class="item"><?php if(count($docFiles) == 0) { echo Yii::t('app', 'Kein Dokument'); } else { 
		    		foreach ($docFiles as $doc) {
		    			?>
		    			<a href="<?php echo $doc['web']; ?>" style="<?php echo (!$doc['app'] ? 'text-decoration: line-through;' : '')?>" target="_blank" ><?php echo $doc['name'] ;?></a><?php echo (!$doc['app'] ? Yii::t('app', ' (nicht bestätigt!)') : '') ;?><br>
		    			<?php
		    		}
		    	}?></div>

		    	<div style="clear:both;"></div>
		    </div>
	 	
	    	<div class="items-edit">
		    	<?php $form = ActiveForm::begin([])?>
		    	<input type="hidden" name="part" value="job-cover">
		    	<div class="item-title"><?php echo Yii::t('app', 'Anschreiben'); ?></div>
		    	<div class="item">
		    		<textarea name="CandidateBase[coverletter]" ><?=$candidateModel->coverletter ?></textarea>
		    	</div>
		    	<div class="item-title" style="margin-top:115px;"><?php echo Yii::t('app', 'Anlagen hinzufügen'); ?></div>
		    	<div class="item" style="margin-top:115px;">
		    		<label class="fileContainer">
					     <?php echo Yii::t('app', 'Datei hochladen'); ?>
					    <input type="file" multiple id="candidate_doc" name="candidate_doc" file-model="candidate_doc" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
					</label>	
					<div class="file_title"></div>    	
		    	</div>
		    	<div style="clear:both;"></div>
		    	<?php ActiveForm::end()?>
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
    	
    <div style="clear:both;"></div>
</div>   
	<div ng-show="loadingshow" class="fade-in-out loading-full"></div>
</div>

<?php $form = ActiveForm::begin(['id' => 'checkform' , 'action' => Yii::getAlias('@web/candidate/check')])?>
<input type="hidden" id="hdncheckmode" name="mode" />
<input type="hidden" id="hdncheckdata" name="data" />
<?php ActiveForm::end() ?>

<div id="skillbrowser" ng-show="showskillbrower" class="fade-in-out"  >
	<div class="skillbrowspannel">
		<div style="width: 100%;"> 
			<div class="skillbrowstitle"><?php echo Yii::t('app', 'Fähigkeit hinzufügen'); ?></div>
			<button id="closeskillbrows" ng-click="showskillbrower=false"></button>
		</div>
		<div> 
			<input style="" id="skillbrowstext" >
			<button id="clearskillbrows" style=""></button>
		</div>
		<div style="clear: both;"></div>
		
		<div class="skillbrowsbottom">
			<button id="addskill" ng-click="addskill()"><?php echo Yii::t('app', 'Hinzufügen'); ?></button>
		</div>
		
	</div>
</div>

<script>
	var availe_date_row = '<li id="availability_date_li" style="width: 130px; padding-left: 2px;"><?php echo Yii::t('app', 'Ab'); ?>&nbsp;<input type="text" name="CandidateBase[availablefrom]" style="z-index: 100;position: relative;" value="<?=date('d.m.Y') ?>" /><span class="brows_date"></span></li>';

	var skills = <?php echo json_encode($allskills);?>;
	var skills_title = <?php echo json_encode(array_values($allskills) );?>;
	var skills_id = <?php echo json_encode(array_keys($allskills) );?>;

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
	


	var cities = new Array();
	var cities_country = new Array();
	var postcodes = new Array();
	var postcodes_city = new Array();
	
	$(document).ready(function(){
		<?php foreach($skills as $skill){?>
		add_skill("<?php echo $skill; ?>");
		<?php } ?>

	});

	
</script>
