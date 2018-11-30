<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helper\BrainStaticList;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */

$fromapply = isset($fromapply) ? $fromapply : false;

$this->title = Yii::t('app', 'Bewerber Vorschau');
if(!$fromapply){
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bewerber'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;
}

$formatter = \Yii::$app->formatter;

?>
<div class="candidate-view">

    <h1><?= Html::encode($this->title) ?></h1>
	<?php if(!$fromapply){?>
    <p>
        <?= $readonly ? '' : Html::a(Yii::t('app', 'Bearbeiten'), ['update', 'id' => $model->userid], ['class' => 'btn btn-primary']) ?>
        <?= $readonly ? '' : Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->userid], [
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
            //'userid',
            //'title',
        	[
        		'label' => Yii::t('app', 'Vollname'),
        		'value' => $model->title . ' ' . $model->user()->fullname(),
        	],
        	[
        		'label' => Yii::t('app', 'Geburtsdatum'),
        		'value' => $formatter->asDate($model->user()->bdate, 'php:d.m.Y') ,
        	],
            //'photo',
            'email:email',
            'pcode',
            'city',
            'country',
            'address',
            'cellphone',
            'tel',
        	'title2',
            'nationality',
        	'reachability',
            'contacttime',
            //'employment',
        	[
        		'label' => $model->user()->attributeLabels()['receive_backend_email'],
        		'value' => BrainStaticList::janeinList(false)[$model->user()->receive_backend_email],
        	],
        	[
        		'label' => Yii::t('app', 'Job-Sorte'),
        		'value' => $model->jobtype > 0 ? $model->getJobtype()->title : '',
        	],
        	'availability',
            //'jobtype',
        	[
        		'label' => Yii::t('app', 'Job-Sorte'),
        		'value' => $model->jobtype > 0 ? $model->getJobtype()->title : '',
        	],
        	'availablefrom',
            'desiredjobpcode',
            'desiredjobcity',
            'desiredjobcountry',
            //'desiredjobregion',
        	[
        		'label' => Yii::t('app', 'gewünschter Umkreis'),
        		'value' => $model->desiredjobregion > 0 ? $model->desiredjobregion . ' km' : '',
        	],
        	'coverletter:ntext',
            //'createdate',
            //'updatedate',
        ],
    ]) ?>

</div>
