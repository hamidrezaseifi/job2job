<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helper\BrainStaticList;

/* @var $this yii\web\View */
/* @var $model common\lib\CompanyBase */

$fromapply = isset($fromapply) ? $fromapply : false;

$this->title = Yii::t('app', 'Unternehmer Vorschau');
if(!$fromapply){
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unternehmen'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
}
$formatter = \Yii::$app->formatter;
$allconnected = $model->connectedCompanies();
$connected = '';
foreach ($allconnected as $comp)
{
	$connected .= $comp->name . ',';
}

$personal = $model->personalDecisionMakerList();

$pd1 = [
		'label' => Yii::t('app', 'Personalentscheider'),
		'format' => 'raw',
		'value' => Yii::t('app', 'nicht eingestellt') ,
];

$pd2 = [
			'label' => Yii::t('app', 'Stellvertreter'),
			'format' => 'raw',
			'value' => Yii::t('app', 'nicht eingestellt') ,
		];


//print_r($personal); exit;
foreach ($personal as $ped)
{
	if($ped->isdeputy)
	{
		$pd2['value'] = $ped->title . ' ' . $ped->getUser()->fullname() . ' <a target="_blank" href="' . Yii::getAlias('@web') . '/pdt/view?id=' . $ped->userid . '"><span class="glyphicon glyphicon-new-window"></span></a>' . '<br>' . $ped->email . '<br>' . Yii::t('app', 'Festnetznummer') . ': ' . $ped->tel . '<br>' . Yii::t('app', 'Mobiltelefon') . ': ' . $ped->cellphone;
		
	}
	else 
	{
		$pd1['value'] = $ped->title . ' ' . $ped->getUser()->fullname() . ' <a target="_blank" href="' . Yii::getAlias('@web') . '/pdt/view?id=' . $ped->userid . '"><span class="glyphicon glyphicon-new-window"></span></a>' . '<br>' . $ped->email . '<br>' . Yii::t('app', 'Festnetznummer') . ': ' . $ped->tel . '<br>' . Yii::t('app', 'Mobiltelefon') . ': ' . $ped->cellphone;
		
	}
}

?>
<div class="company-base-view">

    <h1><?= Html::encode($this->title) ?></h1>
<?php if(!$fromapply){?>
    <p>
        <?= Html::a(Yii::t('app', 'Bearbeiten'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            //'id',
            'companyname',
            //'companytype',
        	[
        		'label' => Yii::t('app', 'Geschäftsform'),
        		'value' => ($model->getType() ? $model->getType()->title : ''),
        	],
        	[
        		'label' => Yii::t('app', 'Gründungsdatum'),
        		'value' => $formatter->asDate($model->founddate, 'php:d.m.Y') ,
        	],
        	[
        		'label' => Yii::t('app', 'Verbundene Unternehmen'),
        		'value' => $connected ,
        	],
        	//'founddate',
            //'adress:ntext',
            'taxid',
            'homepage',
            //'logo',
            //'employeecountindex',
        	[
        		'label' => Yii::t('app', 'Anzahl der Mitarbeiter'),
        		'value' => BrainStaticList::employeeCountList()[$model->employeecountindex] ,
        	],
        	[
        		'label' => Yii::t('app', 'Status'),
        		'value' => $model->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', 'Inaktiv') ,
        	],
        	$pd1,
        	$pd2,
        	//'status',
            //'createdate',
            //'updatedate',
        ],
    ]) ?>

</div>
