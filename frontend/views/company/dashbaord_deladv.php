<?php

/* @var $this yii\web\View */
/* @var $model \common\models\Users */
/* @var $modelSecond \common\models\Users */
/* @var $companyModel \common\lib\CompanyBase */
/* @var $pdmModel \common\lib\PersonaldecisionmakerBase */
/* @var $pdmModelSecond \common\lib\PersonaldecisionmakerBase */
/* @var $searchModel \common\lib\PersonaldecisionmakerBase */
/* @var $searchModel \common\lib\PersonaldecisionmakerBase */
/* @var $dataProvider \common\lib\PersonaldecisionmakerBase */
/* @var $jobadvList array */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->registerCssFile("@web/web/css/profileunternehmen.css", [], 'css-profileunternehmen');
$this->registerCssFile("@web/web/css/styleradio.css", [], 'css-style-radio');
$this->registerCssFile("@web/web/css/stylecheckbox.css", [], 'css-style-checkbox');
$this->registerCssFile("@web/web/css/jobadv.css", [], 'css-jobadv');

$formatter = \Yii::$app->formatter;

?>
<div class="register-bewerbung">
    
    <div class="register-bewerbung-title j2jgreenback">
    	<?php echo Yii::t('app', 'Job Anzeigen löchen'); ?>
    </div>
    
    <div class="job-adv-list">
    	
    	<div style="font-size: 16px;"><?php echo Yii::t('app', 'Sind Sie sicher diese Job-Anzeigen:?') . '<br>' . $jobModel->title . '<br>' . Yii::t('app', 'zu löchen?'); ?></div>
    	
		<div style="margin-top: 20px; height: 20px;">
     <?php $form = ActiveForm::begin(['options' =>['id' => 'formnewadv']])?>
     <?=Html::hiddenInput('delete', 'ok') ?>
    <a href="<?php echo Yii::getAlias('@web') . '/company/dashboard/jobs';?>" class="deletejobcancel"><?php echo Yii::t('app', 'zurück zu der Liste'); ?></a>
     <?=Html::submitButton(Yii::t('app', 'Löschen?'), ['class' => 'deletejob']) ?>
     <?php $form = ActiveForm::end()?>
    
    	</div>    	
    </div>
    

</div>



