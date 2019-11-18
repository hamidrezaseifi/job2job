<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helper\BrainHelper;
use common\helper\BrainStaticList;

/* @var $this yii\web\View */
/* @var $model common\lib\JobPositionBase */

$this->title = Yii::t('app', 'Stellenanzeige Anzeigen');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stellenanzeige'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$formatter = Yii::$app->formatter;
$formatter->locale = 'de-DE';
?>
<div class="job-position-base-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Bearbeiten'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Treffer'), ['match', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Möchten Sie diesen Artikel wirklich löschen?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        	[
        		'label' => Yii::t('app', 'Unternehmer'),
        		'format' => 'raw',
        		'value' => $model->getCompany()->companyname . ' <a target="_blank" href="' . Yii::getAlias('@web') . '/company/view?id=' . $model->companyid . '"><img alt="" src="' . Yii::getAlias('@web') . '/web/images/icons/opne-new.png" width="20"></a>',
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
        		'label' => Yii::t('app', 'Notiz'),
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
