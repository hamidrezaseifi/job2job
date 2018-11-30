<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\helper\BrainHelper;

/* @var $this yii\web\View */
/* @var $jobposModel common\lib\JobpositionBase */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', Yii::t('app', 'Passende Bewerber-Liste für die Stellenanzeige "' . $jobposModel->title . '"'));
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Stellenanzeige'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="candidate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => false,
        'columns' => [
        		['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['style' => 'width : 80px;'],],
        		[
        				'label' => Yii::t('app', 'Vollname'),
        				//'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return $model->title . ' ' . $model->user()->fullname();}
        		],
        		[
        				'label' => Yii::t('app', 'Herstellungsdatum'),
        				'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return \Yii::$app->formatter->asDate($model->createdate , 'php:d.m.Y');}
        		],
        		[
        				'label' => Yii::t('app', 'Verfügbarkeit'),
        				'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return $model->availability . ( $model->availability == 'Verfügber' ? ' ( ab ' . \Yii::$app->formatter->asDate($model->availablefrom , 'php:d.m.Y') . ' )' : '');}
        		],
        		[
        				'label' => Yii::t('app', 'Erreichbarkeit'),
        				'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return $model->reachability . ( ' ( ' . $model->contacttime . ' )');}
        		],
        		[
        				'label' => Yii::t('app', 'Kontakt'),
        				'format' => 'raw',
        				'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ 
        				return 
        					($model->tel != '' ? '<b>'.Yii::t('app', 'Festnetznummer') . ': ' . '</b>'.$model->tel . '<br>' : '').
        					($model->cellphone != '' ? '<b>'.Yii::t('app', 'Mobiltelefon') . ': ' . '</b>'.$model->cellphone . '<br>' : '').
        					($model->email != '' ? '<b>'.Yii::t('app', 'E-Mail') . ': ' . '</b>'.$model->email : '');       					;
        		}
        		],
        		[
        				'label' => Yii::t('app', 'Status'),
        				'headerOptions' => ['style' => 'width : 100px;'],
        				'value' => function($model){ return $model->user()->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', 'Deaktiv');}
        		],
        		[
        		'class' => 'yii\grid\ActionColumn',
        		'headerOptions' => ['style' => 'width : 40px;'],
        		'template' => '{view}',
        		'buttons' => [
        				'view' => function ($url, $model, $key) {
        		
        				return '<a target="_blank" href="' . Yii::getAlias('@web') . '/candidate/view?readonly=1&id=' . $model->userid . '" title="' . Yii::t('app', 'View') . '" ><span class="glyphicon glyphicon-eye-open"></span></a>';
        				},
        				],
        				],
 
        		
        ],
    ]); ?>
</div>