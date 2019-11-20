<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\HtmlHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\EmailtextBaseSearch */
/* @var $model backend\models\EmailForm */

$this->title = Yii::t('app', 'Gruppen E-Mail');
$this->params['breadcrumbs'][] = $this->title;



?>
<div class="emailtext-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>

    <?php $form = ActiveForm::begin(); ?>
    	<?= $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?> 

    	<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?> 
	
    	<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Senden'), ['class' => 'btn btn-primary']) ?>
        </div>
    
	<?php ActiveForm::end(); ?>

   
</div>
