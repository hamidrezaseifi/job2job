<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\lib\SkillsBase;

/* @var $this yii\web\View */
/* @var $model common\models\Skills */
/* @var $form yii\widgets\ActiveForm */
/* @var $parentpath string */
/* @var $ajax boolean */

$this->registerJsFile(Yii::$app->urlManager->createUrl('web/js/jstree.js')  , ['position' => 3]);
$this->registerJsFile(Yii::$app->urlManager->createUrl('web/js/skillform.js')  , ['position' => 3]);

$this->registerCssFile(Yii::$app->urlManager->createUrl('web/css/default/style.css'));

$formoptions = array();
if($ajax)
{
	$formoptions = array('onsubmit' => $model->isNewRecord ? 'return do_insert_skill();' : 'return do_edit_skill(' . $model->id . ');');
}

$statusitems = array( SkillsBase::StatusActive => SkillsBase::statusTitle(SkillsBase::StatusActive) 
		, SkillsBase::StatusDeactive => SkillsBase::statusTitle(SkillsBase::StatusDeactive) 
		, SkillsBase::StatusNotApproved => SkillsBase::statusTitle(SkillsBase::StatusNotApproved)
);
?>

<div class="skills-form">

    <?php $form = ActiveForm::begin(['options'=>$formoptions, 'validateOnSubmit' => true, 'id' => 'frmskill' ]); ?>

    <?= $form->field($model, 'parentid')->hiddenInput(['id' =>'hdparent']) ?>
    <?= Html::input('text', '' , $parentpath , ['class' => 'form-control' , 'readonly' => 'readonly' , 'id' =>'txtparent' , 'onclick' => (!$ajax ? 'select_skill();' : '')]) ?><br>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true , 'required' => 'required' , ]) ?>

    <?= $form->field($model, 'status')->radioList($statusitems) ?>

    <div class="form-group">
    	<?php 
         	echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    		
         ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div id="dvtree"></div>
<script>
	var rooturl = "<?=Yii::getAlias('@web') ?>/skills/";
</script>
