<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\HtmlHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\EmailtextBaseSearch */
/* @var $model backend\models\EmailForm */
/* @var $errmsg string */
/* @var $okmsg string */

$this->title = Yii::t('app', 'Gruppen E-Mail');
$this->params['breadcrumbs'][] = $this->title;

//groupemail.css
$this->registerCssFile("@web/web/css/groupemail.css", [], 'css-groupemail');
$this->registerJsFile("@web/web/js/groupemail.js", [], 'js-groupemail');


?>
<div class="emailtext-base-index" ng-controller="GroupeemailController">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
	
    <?php $form = ActiveForm::begin(['enableClientScript' => false, 'action' => ['mail']]); ?>
    
    	<?= $form->field($model, 'receiver')->textInput(['maxlength' => true, 'required' => true, 'class' => 'form-control receiver', 'ng-value' => 'allEmailAreSelectedInText()']) ?> 

    	<?= $form->field($model, 'title')->textInput(['maxlength' => true, 'required' => true, 'class' => 'form-control title', 'ng-model' => 'selectedTitle']) ?> 
	
    	<?= $form->field($model, 'body')->textarea(['rows' => 6, 'required' => true, 'ng-model' => 'selectedText']) ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Senden'), ['class' => 'btn btn-primary']) ?>
        </div>
    
	<?php ActiveForm::end(); ?>
	<?php if($errmsg){?>
	<div class="alert alert-danger"><?=$errmsg ?></div>
	<?php } ?>
	<?php if($okmsg){?>
	<div class="alert alert-success"><?=$okmsg ?></div>
	<?php } ?>

    <div class="modal fade" id="usersmodal" tabindex="-1" role="dialog" aria-labelledby="usersmodalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered users-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Empfänger-Liste</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
			<div class="select-all-email"><input ng-checked="allEmailAreSelected()" ng-click="selectAllEmails()" type="checkbox" > &nbsp; &nbsp; Alle Auswählen</div>
			
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="userstab-tab" data-toggle="tab" href="#userstab" role="tab" aria-controls="userstab" aria-selected="true">Bewerber</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="companiestab-tab" data-toggle="tab" href="#companiestab" role="tab" aria-controls="companiestab" aria-selected="false">Unternehmen</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="userstab" role="tabpanel" aria-labelledby="userstab-tab">
                    <ul class="list-group">
                      <li ng-repeat="candidate in users.candidates" class="list-group-item users-item">
                      	<input ng-checked="selectedEmails[candidate.email]" ng-model="selectedEmails[candidate.email]" type="checkbox" > 
                      	{{candidate.name}} ({{candidate.status}}) {{candidate.email}} 
                      </li>
                    </ul>					
				</div>
              	<div class="tab-pane fade" id="companiestab" role="tabpanel" aria-labelledby="companiestab-tab">
                    <ul class="list-group">
                      <li ng-repeat="company in users.companies" class="list-group-item users-item">
                      	<div class="company">{{company.name}} ({{company.status}})</div>
                      	<div class="companyuser" ng-repeat="compuser in company.users">
                      		<input ng-checked="selectedEmails[compuser.email]" ng-model="selectedEmails[compuser.email]" type="checkbox" > {{compuser.name}} ({{compuser.pos}}) ({{compuser.status}}) {{compuser.email}}
                      	<div></div> 
                      </li>
                    </ul>					
				
				</div>
            </div>


          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/icons/close.png" width="20"></button>
            <button type="button" class="btn btn-primary" ng-click="applySelectedEmail()"><img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/icons/done.png" width="20"></button>
          </div>
        </div>
      </div>
    </div>




    <div class="modal fade" id="textsmodal" tabindex="-1" role="dialog" aria-labelledby="textsmodalTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered users-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Text-Liste</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <div class="text-title-list">
                <ul class="list-group">
                  <li ng-repeat="(id, text) in textList" ng-click="previewText(id)" class="list-group-item users-item">
                   	{{text.title}} 
                  </li>
                  <li ng-repeat="(id, text) in textList" ng-click="previewText(id)" class="list-group-item users-item">
                   	{{text.title}} 
                  </li>
                  <li ng-repeat="(id, text) in textList" ng-click="previewText(id)" class="list-group-item users-item">
                   	{{text.title}} 
                  </li>
                </ul>					
            	
            </div>
            <div class="text-content" ng-bind-html="renderPreviewText()"></div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/icons/close.png" width="20"></button>
            <button type="button" class="btn btn-primary" ng-click="selectText()"><img alt="" src="<?=Yii::getAlias('@web') ?>/web/images/icons/done.png" width="20"></button>
          </div>
        </div>
      </div>
    </div>
   
</div>
<script>
var loadusersurl = "<?=Url::toRoute(['groupeemail/loadusers']);?>";
var loademailtextsurl = "<?= Url::toRoute(['groupeemail/loademailtexts']);?>";
</script>