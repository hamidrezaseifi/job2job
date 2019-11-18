<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\NavigationAccessTreeView;

/* @var $this yii\web\View */
/* @var $model common\lib\UsergroupBase */
/* @var $form yii\widgets\ActiveForm */
/* @var $status_list array */



?>

<div class="user-group-base-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true , 'required' => 'required' , 'pattern' => "[^\x22]+"]) ?>

    <?= $form->field($model, 'status')->radioList($status_list) ?>

<?php if(!$model->isNewRecord ) {?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Erstellen') : Yii::t('app', 'Bearbeiten'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

	<div class="user-group-base-view">
	<?php 
		echo NavigationAccessTreeView::widget(['viewid' => 'trwnavihation' , 'allow_edit' => true ,
			'viewclass' => 'table table-striped table-bordered' , 'viewstyle' => '' , 
			'groupid' => $model->id,
		]);
	?>
	</div>

<?php } ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Erstellen') : Yii::t('app', 'Bearbeiten'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<script>
//$("#usergroupbase-title").select();
$("#usergroupbase-title").focus();
</script>