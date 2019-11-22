<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helper\BrainHelper;
use backend\components\TelephonPreview;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $candidateModel \common\lib\CandidateBase */
/* @var $userModel \common\lib\UsersBase */
/* @var $form yii\widgets\ActiveForm */
/* @var $titleList array */
/* @var $title2List array */
/* @var $nationalityList array */
/* @var $reachabiltyList array */
/* @var $employeementList array */
/* @var $accessableList array */
/* @var $distanceList array */
/* @var $branchs array */
/* @var $skills array */

$this->registerCssFile("@web/web/css/candidate-form.css", [], 'css-candidate-form');
$this->registerJsFile("@web/web/js/candidate-form.js", [], 'js-candidate-form');

?>

<div class="candidate-form" ng-controller="CandidateController">

    <?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($candidateModel, 'title')->dropDownList($titleList) ?>

    <?= $form->field($candidateModel, 'title2')->dropDownList($title2List) ?>

    <?= $form->field($userModel, 'fname')->textInput(['maxlength' => true, ]) ?>

    <?= $form->field($userModel, 'lname')->textInput(['maxlength' => true, ]) ?>

    <?= $userModel->isNewRecord ? $form->field($userModel, 'password_hash')->passwordInput(['maxlength' => true, ]) : ''?>

    <?= $form->field($userModel, 'bdate')->textInput(['maxlength' => true, 'class' => 'form-control calender-icon']) ?>

    <?= $form->field($candidateModel, 'nationality')->dropDownList($nationalityList) ?>

    <?= $form->field($candidateModel, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>

    <?= $form->field($candidateModel, 'homenumber')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'address1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'pcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'cellphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'tel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'branch')->dropDownList($branchs , ['prompt' => 'Bitte wählen Sie eine Branche aus']) ?>

    <?= $form->field($candidateModel, 'reachability')->checkboxList($reachabiltyList , ['name' => 'reachability', ]) ?>

    <?= $form->field($candidateModel, 'contacttime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'employment')->dropDownList($employeementList) ?>

    <?= $form->field($candidateModel, 'availability')->dropDownList($accessableList) ?>

    <?= $form->field($candidateModel, 'availablefrom')->textInput(['class' => 'form-control calender-icon']) ?>

    <?= $form->field($candidateModel, 'desiredjobpcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'desiredjobcity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'desiredjobregion')->dropDownList($distanceList) ?>

    <?= $form->field($userModel, 'status')->radioList([0 => Yii::t('app', 'Inaktiv'), 1 => Yii::t('app', 'Aktiv')], ['class' => 'form-control', ]) ?>

    <?= $form->field($candidateModel, 'coverletter')->textarea(['rows' => 6]) ?>

	<input type="hidden" id="skillhidden" name="skills">
	
    <div class="form-group field-candidatebase-skills">
        <label class="control-label" for="candidatebase-coverletter">Fähigkeiten</label>
        <input type="text" id="skilltext" ng-keypress="enterSkill($event)" class="form-control skilltext">
        <button type="button" ng-click="addSkillButton()" class="skill-add"></button>
        <div class="skill-group">
            <ul class="list-group">
              <li ng-repeat="skill in skills" class="list-group-item">
              	<span>{{skill}}</span> 
              	<button type="button" ng-click="deleteSkill(skill)" class="skill-delete"></button>
              </li>
            </ul>        
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($candidateModel->isNewRecord ? Yii::t('app', 'Erstellen') : Yii::t('app', 'Speichern'), ['class' => $candidateModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
	var skills = [<?=count($skills) > 0 ? "'" .  implode("','", $skills) . "'" : '' ?>];
</script>
