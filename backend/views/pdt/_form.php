<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\helper\BrainHelper;
use backend\components\TelephonPreview;
use common\helper\BrainStaticList;

/* @var $this yii\web\View */
/* @var $model common\lib\PersonaldecisionmakerBase */
/* @var $form yii\widgets\ActiveForm */

$userModel->bdate = BrainHelper::dateEnglishToGerman($userModel->bdate);

$userModel->createdate = $userModel->isNewRecord ? date('Y-m-d H:i:s') : $userModel->createdate;
$userModel->updatedate = date('Y-m-d H:i:s');

$model->createdate = $model->isNewRecord ? date('Y-m-d H:i:s') : $model->createdate;
$model->updatedate = date('Y-m-d H:i:s');

?>

<div class="personaldecisionmaker-base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'companyid')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'title')->dropDownList($titleList) ?>

    <?= $form->field($model, 'title2')->dropDownList($title2List) ?>

    <?= $form->field($userModel, 'fname')->textInput(['maxlength' => true, ]) ?>

    <?= $form->field($userModel, 'lname')->textInput(['maxlength' => true, ]) ?>

    <?= $userModel->isNewRecord ? $form->field($userModel, 'password_hash')->passwordInput(['maxlength' => true, ]) : '' ?>

    <?= $form->field($userModel, 'bdate')->textInput(['maxlength' => true, 'class' => 'form-control calender-icon']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

	<?php echo TelephonPreview::widget([
			'telephone' => $model->cellphone,
			'name' 		=> 'CandidateBase[cellphone]',
			'id' 		=> 'candidcellphone',
			//'class' 	=> 'mytelclass',
			'label' 	=> $model->attributeLabels()['cellphone'],
	]);?>
	
	<?php echo TelephonPreview::widget([
			'telephone' => $model->tel,
			'name' 		=> 'CandidateBase[tel]',
			'id' 		=> 'candidtel',
			//'class' 	=> 'mytelclass',
			'label' 	=> $model->attributeLabels()['tel'],
	]);?>
    
    <?= $form->field($model, 'reachability')->checkboxList($reachabiltyList , ['name' => 'reachability', ]) ?>

    <?= $form->field($model, 'contacttime')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isdeputy')->checkbox() ?>

    <?= $form->field($model, 'createdate')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'updatedate')->hiddenInput()->label(false) ?>

    <?= $form->field($userModel, 'createdate')->hiddenInput()->label(false) ?>

    <?= $form->field($userModel, 'updatedate')->hiddenInput()->label(false) ?>

    <?= $form->field($userModel, 'usertype')->hiddenInput()->label(false) ?>

    <?= $form->field($userModel, 'status')->radioList([0 => Yii::t('app', 'Inaktiv'), 1 => Yii::t('app', 'Aktiv')], ['class' => 'form-control', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Bearbeiten'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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

