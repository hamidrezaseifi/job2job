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
/* @var $reachabilityList array */
/* @var $connectedCompanies array */
/* @var $founddate string */
/* @var $petbdate string */
/* @var $pdmModelSecondExists bool */
/* @var $companytypes array */
/* @var $employeecountList array */

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
<div class="register-bewerbung" ng-controller="CompanyContentController">
    
    <div class="register-bewerbung-title j2jblueback">
    	<?php echo Yii::t('app', 'Firmenprofil'); ?>
    </div>
    
    <div class="register-bewerbung-logo">
    	<div><img id="mainlogo" alt="" src="<?=Yii::getAlias('@web') ?>/web/images/logo.png"></div>
    	<div><?php echo Yii::t('app', 'Felder mit einem <span class="pflichtfeld-sep j2jgreentext j2jblueback">&nbsp;</span> sind Pflichtfelder und müssen ausgefüllt sein!'); ?></div>
    </div>
    
    <div class="register-bewerbung-teil register-unternehmen-personamgabe-teil">
	    <div class="register-bewerbung-teil-title">
	    	<?php echo Yii::t('app', 'ANGABEN ZUR FIRMA'); ?>
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_down_blue.png" class="imgopen image-section-toggle" style="width:20px;" />
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_up_blue.png" class="imgclose image-section-toggle" style="width:20px; display:none;" />
	    </div>
	    <div class="register-bewerbung-teil-items-container">
	    
	    	<div class="items-preview">
		    	<div class="item-title"><?php echo Yii::t('app', 'Firmenname'); ?></div>
		    	<div class="item "> <?php echo $companyModel->companyname;?> </div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Geschäftsform'); ?></div>
		    	<div class="item "> <?=$companytypes[$companyModel->companytype] ?> </div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Verbundene Unternehmen'); ?></div>
		    	<div class="item top-margin-15">
		    		<?= (count($connectedCompanies) == 0 ? Yii::t('app', 'Kein'): implode(', ', $connectedCompanies)) ?>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Gründungsdatum'); ?></div>
		    	<div class="item "><?php echo $founddate;?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Steuer-ID'); ?></div>
		    	<div class="item "><?php echo $companyModel->taxid;?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Homepage'); ?></div>
		    	<div class="item "><?php echo $companyModel->homepage;?></div>

		    	<div class="item-title"><?php echo Yii::t('app', 'Adress'); ?></div>
		    	<div class="item "><?php echo $companyModel->street . ' ' . $companyModel->homenumber. ', ' . $companyModel->pcode . ' ' . $companyModel->city ;?></div>

		    	<div class="item-title"><?php echo Yii::t('app', 'Anzahl der Mitarbeiter'); ?></div>
		    	<div class="item  top-margin-15"> <?= $employeecountList[$companyModel->employeecountindex]; ?> </div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Logo'); ?></div>
		    	<div class="item <?=($photo_approved ? '' : 'notapprovedparent')?>"><?=($photopath ? '<img src="' . $photopath . '" class="personalphoto3 ' . ($photo_approved ? '' : 'notapproved') . '" >' : '-') ?></div>	  
	    	
	    	</div>
	    	
	    	<div class="items-edit">
	    	<?php ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data']])?>
		    	<div class="item-title"><?php echo Yii::t('app', 'Firmenname'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="CompanyBase[companyname]" required value="<?php echo $companyModel->companyname;?>" />
		    	</div>
	    		<input type="hidden" name="part" value="company">
	    		<input type="hidden" name="MAX_FILE_SIZE" value="2242880" />
		    	<div class="item-title"><?php echo Yii::t('app', 'Geschäftsform'); ?></div>
		    	<div class="item requireditem">
					<?=Html::dropDownList('CompanyBase[companytype]', $companyModel->companytype, $companytypes) ?>
		    	</div>
		    	<div class="item-title skillpart"><?php echo Yii::t('app', 'Verbundene Unternehmen'); ?></div>
		    	<div class="item top-margin-15 skillpart" style="height:80px;">
		    		<div id="skills" style="">
		    			<button type="button" class="brows-button" data-toggle="modal" data-target="#skillbrowser"></button>
		    		</div>
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Gründungsdatum'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" value="<?php echo $founddate;?>" required name="CompanyBase[founddate]" style="position: relative; z-index: 100;" class="calender-icon" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Steuer-ID'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="CompanyBase[taxid]" required value="<?php echo $companyModel->taxid;?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Homepage'); ?></div>
		    	<div class="item">
		    		<input type="text" name="CompanyBase[homepage]" value="<?php echo $companyModel->homepage;?>" />
		    	</div>

		    	<div class="item-title"><?php echo Yii::t('app', 'Adresse'); ?></div>
		    	<div class="item company-address">
		    		<label>Straße</label> &nbsp; <input type="text" name="CompanyBase[street]" value="<?php echo $companyModel->street;?>" /><br>
		    		<label>Hausnr.</label> &nbsp; <input type="text" name="CompanyBase[homenumber]" value="<?php echo $companyModel->homenumber;?>" /><br>
		    		<label>PLZ.</label> &nbsp; <input type="text" name="CompanyBase[pcode]" value="<?php echo $companyModel->pcode;?>" /><br>
		    		<label>Ort</label> &nbsp; <input type="text" name="CompanyBase[city]" value="<?php echo $companyModel->city;?>" /><br>
		    	</div>

		    	<div class="item-title"><?php echo Yii::t('app', 'Anzahl der Mitarbeiter'); ?></div>
		    	<div class="item top-margin-15 company-persons">
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
					    <input type="file" accept="image/*" name="company_logo" id="company_logo" file-model="company_logo" multiple />
					</label>	
					<div class="file_title"></div>    	
		    	</div>
		    	<div class="clear"></div> 
		    	<?php ActiveForm::end() ?>   	
	    	
	    	
                <div id="skillbrowser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <?php echo Yii::t('app', 'Verbundene Firma hinzufügen'); ?>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div>
                			<input style="" id="skillbrowstext" >
                			<button id="clearskillbrows" style=""></button>
                        </div>
                		<div style="clear: both;"></div>
                        
                      </div>
                      <div class="modal-footer">
                      	<button id="addskill" style=""><?php echo Yii::t('app', 'Hinzufügen'); ?></button>  
                      </div>
                    </div>
                  </div>
                </div>
	    	
	    	</div>

			<div class="items-edit-preview-part">
				<div class="applyedit" title="<?php echo Yii::t('app', 'übernehmen'); ?>">&nbsp;</div>
				<div class="showedit" title="<?php echo Yii::t('app', 'Bearbeiten'); ?>">&nbsp;</div>
				<div class="hideedit" title="<?php echo Yii::t('app', 'abbrechen'); ?>">&nbsp;</div>
			</div>
	    	
	    </div>
    	<div class="clear"></div>
    </div>
 
    <div class="register-bewerbung-teil register-unternehmen-kontakt-teil">
	    <div class="register-bewerbung-teil-title">
	    	<div><?php echo Yii::t('app', 'PET(Personalentscheider)'); ?></div>
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_down_blue.png" class="imgopen image-section-toggle" style="width:20px;" />
    		<img src="<?=Yii::getAlias('@web') ?>/web/images/arrow_up_blue.png" class="imgclose image-section-toggle" style="width:20px; display:none;" />	    	
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
		    	<div class="item "><?php echo $petbdate;?></div>
		    
		    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
		    	<div class="item "><?php echo $model->uname;?></div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Mobiltelefon'); ?></div>
		    	<div class="item"><?=$pdmModel->cellphone ?></div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Festnetznummer'); ?></div>
		    	<div class="item"><?=$pdmModel->tel ?> </div>
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
		    	<div class="item stelcertreter nodisplay"> <?=$pdmModelSecond->cellphone ?> </div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Festnetznummer'); ?></div>
		    	<div class="item stelcertreter nodisplay"> <?=$pdmModelSecond->tel ?> </div>
		    	<div class="item-title stelcertreter nodisplay" style="margin-top:15px;"><?php echo Yii::t('app', 'S. Erreichbarkeit'); ?></div>
		    	<div class="item stelcertreter nodisplay" style="margin-top:15px;"> <?=$pdmModelSecond->reachability?> </div>
		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Wann dürfen wir Sie kontaktieren?'); ?></div>
		    	<div class="item stelcertreter nodisplay"><?php echo $pdmModelSecond->contacttime;?></div>
				<?php } ?>
	    	</div>
	    	
	    
	    	<div class="items-edit">
	    
	    	<?php ActiveForm::begin(['options' =>['enctype' => 'multipart/form-data']])?>
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
		    		<input type="text" name="UsersBase[bdate]" style="position: relative; z-index: 100;" required value="<?php echo $petbdate;?>" class="calender-icon" />
		    	</div>
		    
		    	<div class="item-title"><?php echo Yii::t('app', 'E-Mail'); ?></div>
		    	<div class="item requireditem">
		    		<input type="text" name="UsersBase[uname]" required value="<?php echo $model->uname;?>" />
		    	</div>
		    	<div class="item-title">&nbsp;</div>
		    	<div class="item">&nbsp;</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Mobiltelefon'); ?></div>
		    	<div class="item">
		    		<input type="text" name="PersonaldecisionmakerBase[cellphone]" value="<?php echo $pdmModel->cellphone;?>" />
		    	</div>
		    	<div class="item-title"><?php echo Yii::t('app', 'Festnetznummer'); ?></div>
		    	<div class="item">
		    		<input type="text" name="PersonaldecisionmakerBase[tel]" value="<?php echo $pdmModel->tel;?>" />
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
		    			    	
		    	<div class="item-title" style="margin-top:15px;"><?php echo Yii::t('app', 'Stellvertreter'); ?></div>
		    	<div class="item" style="margin-top:15px;">
					<div class="custom-control custom-checkbox custom-control-inline">		
						<input type="checkbox" class="custom-control-input" id="stellvertreter0" name="SecondPersonaldecisionmaker[0]" ng-model="hasSdp" value="0">		
						<label class="custom-control-label" for="stellvertreter0"></label>		
					</div>    		    	
		    	</div>
		    	
		    	<div ng-if="hasSdp">
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
    
    		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Mobiltelefon'); ?></div>
    		    	<div class="item stelcertreter nodisplay">
    		    		<input type="text" name="PersonaldecisionmakerBaseSV[cellphone]" value="<?php echo $pdmModelSecond->cellphone;?>" />
    		    	</div>
    		    	<div class="item-title stelcertreter nodisplay"><?php echo Yii::t('app', 'S. Festnetznummer'); ?></div>
    		    	<div class="item stelcertreter nodisplay">
     		    		<input type="text" name="PersonaldecisionmakerBaseSV[tel]" value="<?php echo $pdmModelSecond->tel;?>" />
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
    		    	<div class="clear"></div>
    		    </div> 
		    	<?php ActiveForm::end() ?>   	

	    	</div>
	    		 
	    		    	
			<div class="items-edit-preview-part">
				<div class="applyedit" title="<?php echo Yii::t('app', 'übernehmen'); ?>">&nbsp;</div>
				<div class="showedit" title="<?php echo Yii::t('app', 'Bearbeiten'); ?>">&nbsp;</div>
				<div class="hideedit" title="<?php echo Yii::t('app', 'abbrechen'); ?>">&nbsp;</div>
			</div>
	    		    	
	    </div>
    	<div class="clear"></div>
    </div>
     
</div>



<script type="text/javascript">
var company_name_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Firmennamen an!'); ?>";
var company_bdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie das Gründungsdatum der Firma an!'); ?>";
var company_taxid_msg = "<?php echo Yii::t('app', 'Bitte geben Sie die Steuer-ID der Firma an!'); ?>";
var anrede_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie eine Anrede aus!'); ?>";
var fname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie Ihren Vornamen an!'); ?>";
var lname_msg = "<?php echo Yii::t('app', 'Bitte geben Sie Ihren Nachnamen an!'); ?>";
var bdate_msg = "<?php echo Yii::t('app', 'Bitte geben Sie Ihr Geburtsdatum an!'); ?>";
var email_msg = "<?php echo Yii::t('app', 'Bitte geben Sie Ihre E-Mail-Adresse an!'); ?>";
var email_invalid_msg = "<?php echo Yii::t('app', 'Die E-Mail-Adresse ist ungültig.\nBitte geben Sie eine gültige E-Mail an!'); ?>";
var email_exists_msg = "<?php echo Yii::t('app', 'Die E-Mail existiert bereits.\nBitte geben Sie eine andere E-Mail-Adresse an!'); ?>";
var curstatus_msg = "<?php echo Yii::t('app', 'Bitte erklären Sie ihre Beschäftigung!'); ?>";
var avail_msg = "<?php echo Yii::t('app', 'Bitte nennen Sie uns Ihre aktuelle Verfügbarkeit!'); ?>";
var condition_msg = "<?php echo Yii::t('app', 'Bitte stimmen Sie die Nutzungsbedingungen und die Datenschutzerklärung!'); ?>";

var anrede_sv_msg = "<?php echo Yii::t('app', 'Bitte wählen Sie eine Anrede für den Stellvertreter aus!'); ?>";
var fname_sv_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Vornamen des Stellvertreters an!'); ?>";
var lname_sv_msg = "<?php echo Yii::t('app', 'Bitte geben Sie den Nachnamen des Stellvertreters an!'); ?>";
var bdate_sv_msg = "<?php echo Yii::t('app', 'Bitte geben Sie das Geburtsdatum des Stellvertreters an!'); ?>";
var email_sv_msg = "<?php echo Yii::t('app', 'Bitte geben Sie die E-Mail-Adresse des Stellvertreters an!'); ?>";
var email_sv_invalid_msg = "<?php echo Yii::t('app', 'Die E-Mail-Adresse für den Stellvertreter ist ungültig.\nBitte geben Sie eine gültige E-Mail des Stellvertreters an!'); ?>";
var hasSdp = <?php echo $pdmModelSecondExists ? 'true' : 'false'; ?>;


$(document).ready(function(){
	<?php foreach($connectedCompanies as $skill){?>
	add_skill("<?php echo $skill; ?>");
	<?php } ?>

});

</script>
