<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helper\BrainHelper;
use backend\components\TelephonPreview;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $candidateModel common\models\CandidateBase */
/* @var $userModel common\models\UsersBase */
/* @var $form yii\widgets\ActiveForm */

$userModel->bdate = BrainHelper::dateEnglishToGerman($userModel->bdate);

?>

<div class="candidate-form">

    <?php $form = ActiveForm::begin(); ?>
	
    <?= $form->field($candidateModel, 'title')->dropDownList($titleList) ?>

    <?= $form->field($candidateModel, 'title2')->dropDownList($title2List) ?>

    <?= $form->field($userModel, 'fname')->textInput(['maxlength' => true, ]) ?>

    <?= $form->field($userModel, 'lname')->textInput(['maxlength' => true, ]) ?>

    <?= $form->field($userModel, 'bdate')->textInput(['maxlength' => true, 'class' => 'form-control calender-icon']) ?>

    <?= $form->field($candidateModel, 'nationality')->dropDownList($nationalityList) ?>

    <?= $form->field($candidateModel, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>

    <?= $form->field($candidateModel, 'pcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'country')->dropDownList($countryList) ?>

    <?= $form->field($candidateModel, 'address')->textInput(['maxlength' => true]) ?>

	<?php echo TelephonPreview::widget([
			'telephone' => $candidateModel->cellphone,
			'name' 		=> 'CandidateBase[cellphone]',
			'id' 		=> 'candidcellphone',
			//'class' 	=> 'mytelclass',
			'label' 	=> $candidateModel->attributeLabels()['cellphone'],
	]);?>
	
	<?php echo TelephonPreview::widget([
			'telephone' => $candidateModel->tel,
			'name' 		=> 'CandidateBase[tel]',
			'id' 		=> 'candidtel',
			//'class' 	=> 'mytelclass',
			'label' 	=> $candidateModel->attributeLabels()['tel'],
	]);?>

    <?= $form->field($candidateModel, 'reachability')->checkboxList($reachabiltyList , ['name' => 'reachability', ]) ?>

    <?= $form->field($candidateModel, 'contacttime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'employment')->dropDownList($employeementList) ?>

    <?= $form->field($candidateModel, 'availability')->dropDownList($accessableList) ?>

    <?= $form->field($candidateModel, 'jobtype')->dropDownList($worktypeList) ?>

    <?= $form->field($candidateModel, 'availablefrom')->textInput() ?>

    <?= $form->field($candidateModel, 'desiredjobpcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'desiredjobcity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($candidateModel, 'desiredjobcountry')->dropDownList($countryList) ?>

    <?= $form->field($candidateModel, 'desiredjobregion')->dropDownList($distanceList) ?>

    <?= $form->field($candidateModel, 'desiredjobtimetype')->dropDownList($worktypeList) ?>

    <?= $form->field($userModel, 'status')->radioList([0 => Yii::t('app', 'Inaktiv'), 1 => Yii::t('app', 'Aktiv')], ['class' => 'form-control', ]) ?>

    <?= $form->field($candidateModel, 'coverletter')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($candidateModel->isNewRecord ? Yii::t('app', 'Erstellen') : Yii::t('app', 'Speichern'), ['class' => $candidateModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
	$(document).ready(function(){
		$.datepicker.setDefaults($.datepicker.regional["de"]);
		$("input.calender-icon").datepicker({
		      changeMonth: true,
		      changeYear: true,
		      //maxDate: "-17Y"
		    });

	});
</script>
