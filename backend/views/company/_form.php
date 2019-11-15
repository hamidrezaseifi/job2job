<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helper\BrainHelper;
use backend\components\TelephonPreview;

/* @var $this yii\web\View */
/* @var $model common\lib\CompanyBase */
/* @var $companytypeList array */
/* @var $employeecountList array */
/* @var $logoModel common\lib\UploadedfilesBase */
/* @var $personalEntscheiderModel common\lib\PersonaldecisionmakerBase */
/* @var $stellVertreterModel common\lib\PersonaldecisionmakerBase */
/* @var $personalEntscheiderUserModel common\lib\UsersBase */
/* @var $stellVertreterUserModel common\lib\UsersBase */
/* @var $connectedCompanies array */
/* @var $logopath string */
/* @var $titleList array */
/* @var $title2List array */
/* @var $reachabiltyList array */

$this->registerCssFile("@web/web/css/company-form.css", [], 'css-company-form');
$this->registerJsFile("@web/web/js/company-form.js", [], 'js-company-form');

$showlogopath = $logopath ? $logopath : Yii::getAlias('@web') . '/web/images/person.png';
$logochangeurl = Yii::getAlias('@web') . '/company/setlogo';


?>
<style>
  
  #connectedcompanylist .ui-selecting { background: #FECA40; }
  #connectedcompanylist .ui-selected { background: #F39814; color: white; }
  .connectedcompanylist-container { max-height: 170px; border: 2px solid gray; padding: 8px; border-radius: 4px; }
  #connectedcompanylist { list-style-type: none; margin: 0; padding: 0; width: calc(100% - 20px); max-heigh: 120px; overflow-y: auto; }
  #connectedcompanylist li { cursor: pointer; margin: 3px; padding: 1px; padding-left: 6px; padding-right: 6px; float: left; max-width: 210px; height: 30px; text-align: center; }
</style>
 
<div style="clear: both;"></div>
  
<div class="company-base-form" ng-controller="CompanyController">
	<?php if(!$model->isNewRecord) {?>
    <?php $form = ActiveForm::begin(['id' => 'logoform', 'action' => $logochangeurl, 'options' =>['enctype' => 'multipart/form-data'],]); ?>
	<input type="hidden" name="setlogo" value="1">
	<input type="hidden" name="cid" value="<?php echo $model->id;?>">
    <div class="form-group field-companybase-logo has-success" style="margin-bottom: 20px;">
	
		<div style=""><label class="control-label" for="companybase-logo">Logo</label></div>
		<div style="width: 90px; float:left; margin-left: 50px;"><?php 
			echo Html::img($showlogopath, ['style' => 'width: 70px;', 'id' => 'logopreview']);
		?></div>
		<?php if($logopath){?>
		<?php if($logoModel){?>
		<div style="width: 20px; float:left; margin-top: 20px;">
			<a href="<?php echo $logochangeurl . '?ac=ok&uid=' . $logoModel->id . '&cid=' . $model->id;?>" title="<?=Yii::t('app', 'bestätigen') ?>" ><span class="glyphicon glyphicon-ok"></span></a>
		</div>
		<?php } ?>
		<div style="width: 100px; float:left; margin-top: 20px;">
			<a href="<?php echo $logochangeurl . '?ac=del&cid=' . $model->id . ($logoModel ? '&uid=' . $logoModel->id : '');?>" title="<?=Yii::t('app', 'Löschen') ?>" ><span class="glyphicon glyphicon-trash"></span></a>
		</div>
		<?php } ?>
		<div style="width: 320px; float:left; margin-top: 20px;"><input type="file" onchange="$('#setlogolink').show();" accept="image/*" name="company_logo" id="company_logo" multiple /></div>
		<div style="width: 20px; float:left; margin-top: 20px;">
			<a href="" title="<?=Yii::t('app', 'speichern') ?>" style="display:none;" id="setlogolink" onclick="$('#logoform').submit(); return false;" ><span class="glyphicon glyphicon-ok"></span></a>
		</div>
	
	
		<div style="clear: both;"></div>
	</div>

    <?php ActiveForm::end(); ?>
	<?php } ?>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'companyname')->textInput(['maxlength' => true]) ?>

	<div class="form-group">
		<label><?=Yii::t('app', 'Verbundene Unternehmen') ?></label>&nbsp;&nbsp;&nbsp;
		<a href="javascript:void()" title="Löschen" id="addconnectedcompany"><span class="glyphicon glyphicon-plus"></span></a>
		<a href="javascript:void()" title="Löschen" id="deleteconnectedcompany"><span class="glyphicon glyphicon-trash"></span></a>
		<div class="connectedcompanylist-container form-group">
			<ol id="connectedcompanylist">
			<?php foreach ($connectedCompanies as $connectedCompany){?><li class="ui-state-default"><?php echo $connectedCompany->name; ?><input type="hidden" name="connectedcompanies[]" value="<?php echo $connectedCompany->name; ?>" /></li> <?php } ?>
			</ol>
		</div>  
	</div>  

    <?= $form->field($model, 'companytype')->dropDownList($companytypeList) ?>

    <?= $form->field($model, 'founddate')->textInput(['class' => 'form-control calender-icon founddate']) ?>

    <?= $form->field($model, 'taxid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'homepage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employeecountindex')->dropDownList($employeecountList) ?>

    <?= $form->field($model, 'isjob2job')->radioList([0 => Yii::t('app', 'Nein'), 1 => Yii::t('app', 'Ja')], ['class' => 'form-control', ]) ?>

    <?= $form->field($model, 'status')->radioList([0 => Yii::t('app', 'Inaktiv'), 1 => Yii::t('app', 'Aktiv')], ['class' => 'form-control', ]) ?>

	<div class="form-group form-control personal-container">
		<label class="control-label" for="companybase-employeecountindex"><?=Yii::t('app', 'Personalentscheider')?></label>
		
		<div class="personal-data">
       
            <?= $form->field($personalEntscheiderModel, 'title')->dropDownList($titleList, ['name' => 'PET[title]']) ?>
        
            <?= $form->field($personalEntscheiderModel, 'title2')->dropDownList($title2List, ['name' => 'PET[title2]']) ?>
        
            <?= $form->field($personalEntscheiderUserModel, 'fname')->textInput(['maxlength' => true , 'required' => true, 'name' => 'PETUsersBase[fname]' ]) ?>
        
            <?= $form->field($personalEntscheiderUserModel, 'lname')->textInput(['maxlength' => true , 'required' => true , 'name' => 'PETUsersBase[lname]' ]) ?>
        
            <?= $personalEntscheiderUserModel->isNewRecord ? $form->field($personalEntscheiderUserModel, 'password_hash')->passwordInput(['maxlength' => true , 'required' => true  , 'name' => 'PETUsersBase[password_hash]']) : '' ?>
        
            <?= $form->field($personalEntscheiderUserModel, 'bdate')->textInput(['maxlength' => true, 'class' => 'form-control calender-icon petbdate' , 'name' => 'PETUsersBase[bdate]']) ?>
        
            <?= $form->field($personalEntscheiderModel, 'email')->textInput(['maxlength' => true , 'required' => true, 'name' => 'PET[email]']) ?>
        
            <?= $form->field($personalEntscheiderModel, 'cellphone')->textInput(['maxlength' => true, 'name' => 'PET[cellphone]']) ?>

            <?= $form->field($personalEntscheiderModel, 'tel')->textInput(['maxlength' => true, 'name' => 'PET[tel]']) ?>
            
            <?= $form->field($personalEntscheiderModel, 'reachability')->checkboxList($reachabiltyList , ['name' => 'PET[reachability]', ]) ?>
        
            <?= $form->field($personalEntscheiderModel, 'contacttime')->textInput(['maxlength' => true, 'name' => 'PET[contacttime]']) ?>
        
            <?= $form->field($personalEntscheiderUserModel, 'status')->radioList([0 => Yii::t('app', 'Inaktiv'), 1 => Yii::t('app', 'Aktiv')], ['class' => 'form-control', 'name' => 'PETUsersBase[status]' ]) ?>
                
	
		</div>
	</div>

	<div class="form-group form-control personal-container">
		<label class="control-label" for="companybase-employeecountindex"><?=Yii::t('app', 'Stellvertreter')?></label>
		<input type="checkbox" ng-checked="!deputy.isNew" ng-model="showDeputy">
		<input type="hidden" name="SV[set]" ng-value="showDeputy">
		<div class="personal-data" ng-if="showDeputy">
         
            
        
            <?= $form->field($stellVertreterModel, 'title')->dropDownList($titleList, ['name' => 'SV[title]']) ?>
        
            <?= $form->field($stellVertreterModel, 'title2')->dropDownList($title2List, ['name' => 'SV[title2]']) ?>
        
            <?= $form->field($stellVertreterUserModel, 'fname')->textInput(['maxlength' => true , 'required' => true , 'name' => 'SVUsersBase[fname]' ]) ?>
        
            <?= $form->field($stellVertreterUserModel, 'lname')->textInput(['maxlength' => true , 'required' => true , 'name' => 'SVUsersBase[lname]' ]) ?>
        
            <?= $stellVertreterUserModel->isNewRecord ? $form->field($stellVertreterUserModel, 'password_hash')->passwordInput(['maxlength' => true , 'required' => true , 'name' => 'SVUsersBase[password_hash]']) : '' ?>
        
            <?= $form->field($stellVertreterUserModel, 'bdate')->textInput(['maxlength' => true, 'class' => 'form-control calender-icon svbdate' , 'name' => 'SVUsersBase[bdate]' , 'id' => 'svuserbdate']) ?>
        
            <?= $form->field($stellVertreterModel, 'email')->textInput(['maxlength' => true , 'required' => true, 'name' => 'SV[email]']) ?>
        
            <?= $form->field($stellVertreterModel, 'cellphone')->textInput(['maxlength' => true, 'name' => 'SV[cellphone]']) ?>

            <?= $form->field($stellVertreterModel, 'tel')->textInput(['maxlength' => true, 'name' => 'SV[tel]']) ?>
            
            <?= $form->field($stellVertreterModel, 'reachability')->checkboxList($reachabiltyList , ['name' => 'SV[reachability]', ]) ?>
        
            <?= $form->field($stellVertreterModel, 'contacttime')->textInput(['maxlength' => true, 'name' => 'SV[contacttime]']) ?>
        
            <?= $form->field($stellVertreterUserModel, 'status')->radioList([0 => Yii::t('app', 'Inaktiv'), 1 => Yii::t('app', 'Aktiv')], ['class' => 'form-control', 'name' => 'SVUsersBase[status]' ]) ?>
	
		</div>
	</div>
    
	<div class="form-group">
		<?php if($model->isNewRecord){?>
        <button type="submit" class="btn btn-success"><?=Yii::t('app', 'Erstellen')?></button>
        <?php } else {?>
        <button type="submit" class="btn btn-primary"><?=Yii::t('app', 'Speichern')?></button>
        <?php }?>    
    </div>    

    <?php ActiveForm::end(); ?>

</div>

<div class="form-group" id="newconcompany">
	<label class="control-label">Firmenname</label>
	<input type="text" id="concompanyname" class="form-control" maxlength="80">
</div>

<div id="dvbrowspdt">
	<div class="text-container">
		<?php $form = ActiveForm::begin(['method' => 'GET', 'action' => Yii::getAlias('@web') . '/pdt/search' ]); ?>
		<input id="txtbrowsbrowspdt" data-isdep="0" class="form-control" name="name" onkeyup="searchList(this);" maxlength="30">
		<?php ActiveForm::end(); ?>
	</div>
	<div class="form-control listcontainer">
		<img alt="" class="loading" src="<?php echo Yii::getAlias('@web') ?>/web/images/loading.gif" >
		<ul class="list">
		</ul>
	</div>
</div>

<script type="text/javascript">

var companyModel = <?php echo json_encode($model->getAttributes());?>;
companyModel.isNew = <?php echo $model->isNewRecord == 1 ? 'true' : 'false';?>;

var personaldecisionmaker = <?php echo json_encode($personalEntscheiderModel->getAttributes());?>;

var personaldecisionmakerUser = <?php echo json_encode($personalEntscheiderUserModel->getAttributes());?>;

var deputy = <?php echo json_encode($stellVertreterModel->getAttributes());?>;
deputy.isNew = <?php echo $stellVertreterModel->isNewRecord == 1 ? 'true' : 'false';?>;

var deputyUser = <?php echo json_encode($stellVertreterUserModel->getAttributes());?>;

</script>

