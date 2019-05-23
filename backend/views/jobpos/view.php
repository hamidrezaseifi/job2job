<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helper\BrainHelper;
use common\helper\BrainStaticList;

/* @var $this yii\web\View */
/* @var $model common\lib\JobPositionBase */

$fromapply = isset($fromapply) ? $fromapply : false;

$this->title = Yii::t('app', 'Stellenanzeige Vorshau');
if(!$fromapply){
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stellenanzeige'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
}

$formatter = Yii::$app->formatter;
$formatter->locale = 'de-DE';
$updateurl = ['update', 'id' => $model->id];
if($fromcompany)
{
	$updateurl['fromcompany'] = $fromcompany;
}
?>
<div class="job-position-base-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if(!$fromapply){?>
    <p>
        <?= $fromcompany ? Html::a(Yii::t('app', 'Unternehmen'), Yii::getAlias('@web') . '/company/index', ['class' => 'btn btn-primary']) : '' ?>
        <?= Html::a(Yii::t('app', 'Bearbeiten'), $updateurl, ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php } ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        	[
        		'label' => Yii::t('app', 'Unternehmer'),
        		'format' => 'raw',
        		'value' => $model->getCompany()->companyname . ' <a target="_blank" href="' . Yii::getAlias('@web') . '/company/view?id=' . $model->companyid . '"><span class="glyphicon glyphicon-new-window"></span></a>',
    		],
        	'title',
        	[
        		'label' => Yii::t('app', 'Ort'),
        		'value' => $model->postcode . ' ' . $model->city . ' ' . $model->country,
    		],
        	[
        		'label' => Yii::t('app', 'Vakanz'),
        	    'value' => $vacancies[$model->vacancy],
    		],
        	[
        		'label' => Yii::t('app', 'Job-Beginn und Dauer'),
        	    'value' => $formatter->asDate($model->jobstartdate , 'php:F Y') . ' ,' . ($model->duration > 0 ? $model->duration . ' ' . Yii::t('app', 'Monate') : Yii::t('app', 'unbefristet')) . ($model->extends == 1 ? Yii::t('app', '  ,Verlängerung möglich') : ''),
    		],
        	[
        		'label' => Yii::t('app', 'Gültigkeit'),
        		'value' => BrainHelper::dateEnglishToGerman($model->expiredate),
    		],
        	[
        		'label' => Yii::t('app', 'Arbeitszeitmodel'),
        	    'value' => $worktypes[$model->worktype],
    		],
        	[
        		'label' => Yii::t('app', 'Hauptkategorie'),
        	    'value' => $branchs[$model->branch],
        	],
        	[
        		'label' => Yii::t('app', 'Status'),
        		'value' => $model->status == 1 ? Yii::t('app', 'bestätigt') : Yii::t('app', 'nicht bestätigt'),
    		],
        	[
        		'label' => Yii::t('app', 'Beschreibung'),
        		'format' => 'html',
        		'value' => nl2br($model->comments) ,
    		],
            [
                'label' => Yii::t('app', 'Aufgaben'),
                'value' => implode(', ' , BrainHelper::mapTranslate($model->getJobpositiontasks(), 'task', 'task')) ,
            ],
            [
                'label' => Yii::t('app', 'Qualifikationen'),
                'value' => implode(', ' , BrainHelper::mapTranslate($model->getJobpositionskills(), 'skill', 'skill')) ,
            ],
            [
        		'label' => Yii::t('app', 'letzte Bearbeiten'),
        	    'value' => $formatter->asDate($model->updatedate , 'php:d.m.Y H:i'), 
    		],
        		
        ],
    ]) ?>

</div>
