<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\lib\JobPositionBase */
/* @var $form yii\widgets\ActiveForm */

$companyName = '';
$companyID = 0;

$canSelectCompany = true;
if($model->isNewRecord == false && $model->userid != Yii::$app->user->identity->id)
{
	$canSelectCompany = false;
}

if($model->companyid != null)
{
	$company = $model->getCompany();
	if($company)
	{
		$companyName = $company->companyname;
		$companyID = $company->id;
	}
}

$this->registerCssFile("@web/web/css/froala/froala_editor.css", [], 'css-froala_editor');
$this->registerCssFile("@web/web/css/froala/froala_style.css", [], 'css-froala_style');
$this->registerCssFile("@web/web/css/froala/plugins/code_view.css", [], 'css-code_view');
$this->registerCssFile("@web/web/css/froala/plugins/colors.css", [], 'css-froala-colors');
$this->registerCssFile("@web/web/css/froala/plugins/line_breaker.css", [], 'css-froala_line_breaker');
$this->registerCssFile("@web/web/css/froala/plugins/char_counter.css", [], 'css-froala_char_counter');
$this->registerCssFile("@web/web/css/froala/font-awesome.min.css", [], 'css-froala_font-awesome');
$this->registerCssFile("@web/web/css/froala/codemirror.min.css", [], 'css-froala_codemirror');

$this->registerJsFile("@web/web/js/froala/froala_editor.min.js", [], 'js-froala_editor');
$this->registerJsFile("@web/web/js/froala/plugins/align.min.js", [], 'js-froala-align');
$this->registerJsFile("@web/web/js/froala/plugins/char_counter.min.js", [], 'js-froala-char_counter');
$this->registerJsFile("@web/web/js/froala/plugins/code_beautifier.min.js", [], 'js-froala-');
$this->registerJsFile("@web/web/js/froala/plugins/code_view.min.js", [], 'js-froala-code_view');
$this->registerJsFile("@web/web/js/froala/plugins/colors.min.js", [], 'js-froala-colors');
$this->registerJsFile("@web/web/js/froala/plugins/draggable.min.js", [], 'js-froala-draggable');
$this->registerJsFile("@web/web/js/froala/plugins/font_size.min.js", [], 'js-froala-font_size');
$this->registerJsFile("@web/web/js/froala/plugins/font_family.min.js", [], 'js-froala-font_family');
$this->registerJsFile("@web/web/js/froala/plugins/inline_style.min.js", [], 'js-froala-inline_style');
$this->registerJsFile("@web/web/js/froala/plugins/lists.min.js", [], 'js-froala-lists');
$this->registerJsFile("@web/web/js/froala/plugins/paragraph_format.min.js", [], 'js-froala-paragraph_format');
$this->registerJsFile("@web/web/js/froala/plugins/paragraph_style.min.js", [], 'js-froala-paragraph_style');
$this->registerJsFile("@web/web/js/froala/plugins/quote.min.js", [], 'js-froala-quote');

$this->registerCssFile("@web/web/css/jobpos-form.css", [], 'css-jobpos-form');
$this->registerJsFile("@web/web/js/jobpos-form.js", [], 'js-jobpos-form');

?>

<div class="job-position-base-form">

    <?php $form = ActiveForm::begin(); ?>


	<div class="form-group field-st" style="height: 55px;">
		<label class="control-label" for="companybase-employeecountindex"><?=Yii::t('app', 'Unternehmer')?></label>
		<div id="jobpositionbase-company" class="form-control" style="float: left;" ><?=$companyName ?></div>
		<?php if($canSelectCompany) {?>
		<a href="javascript:browsCompany()" class="brows" title=""><span class="glyphicon glyphicon-search"></span></a>
		<a href="javascript:clearCompany()" class="remove" title=""><span class="glyphicon glyphicon-remove"></span></a>
		<?php } ?>
		<div class="clear"></div>
		<input type="hidden" id="jobpositionbase-companyid" name="JobpositionBase[companyid]" value="<?=$companyID ?>">
	</div>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'postcode')->textInput(['maxlength' => true, 'type' => 'number']) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country')->dropDownList($countries) ?>

    <?= $form->field($model, 'vacancy')->dropDownList($vacancies) ?>

    <?= $form->field($model, 'jobstartdate')->textInput(['class' => 'form-control calender-icon', 'id' => 'jobstartdate']) ?>

    <?= $form->field($model, 'duration')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'extends')->checkbox() ?>

    <?= $form->field($model, 'expiredate')->textInput(['class' => 'form-control calender-icon', 'id' => 'expiredate']) ?>

    <?= $form->field($model, 'worktype')->dropDownList($worktypes) ?>

    <?= $form->field($model, 'jobtype')->dropDownList($jobypes) ?>

    <?= $form->field($model, 'status')->radioList([0 => Yii::t('app', 'nicht bestätigt'), 1 => Yii::t('app', 'bestätigt')]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 5, 'id' => 'commentstext']) ?>

    <?= $form->field($model, 'createdate')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'updatedate')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div id="dvbrowscompany">
	<div class="text-container">
		<?php $form = ActiveForm::begin(['method' => 'GET', 'action' => Yii::getAlias('@web') . '/company/search' ]); ?>
		<input id="txtbrowscompany" class="form-control" name="name" onkeyup="searchList(this);" maxlength="30">
		<?php ActiveForm::end(); ?>
	</div>
	<div class="form-control listcontainer">
		<img alt="" class="loading" src="<?php echo Yii::getAlias('@web') ?>/web/images/loading.gif" >
		<ul class="list">
		</ul>
	</div>
</div>



<script>
$(document).ready(function(){
	<?php if($companyID == 0) {?>
	$("a.remove").hide();
	<?php } ?>
});
</script>

