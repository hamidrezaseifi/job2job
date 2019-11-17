<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\helper\BrainStaticList;

/* @var $this yii\web\View */
/* @var $model common\models\Candidate */


$this->title = Yii::t('app', 'Bewerber Vorschau');

	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bewerber'), 'url' => ['index']];
	$this->params['breadcrumbs'][] = $this->title;


$formatter = \Yii::$app->formatter;

?>
<div class="candidate-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Bearbeiten'), ['update', 'id' => $model->userid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Löschen'), ['delete', 'id' => $model->userid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'userid',
            //'title',
        	[
        		'label' => Yii::t('app', 'Vollname'),
        	    'value' => $model->title . ' ' . $model->title2 . ' ' . $model->user()->fullname(),
        	],
        	[
        		'label' => Yii::t('app', 'Geburtsdatum'),
        		'value' => $formatter->asDate($model->user()->bdate, 'php:d.m.Y') ,
        	],
            //'photo',
            'email:email',
            [
                'label' => 'Adress',
                'format' => 'html',
                'value' => $model->street . ' ' . $model->homenumber . '<br> ' . $model->address1 . '<br> ' . $model->pcode . ' ' . $model->city . '<br> ' . $model->country,
            ],
            'cellphone',
            'tel',
            'nationality',
        	'reachability',
            'contacttime',
            'branch',
        	[
        		'label' => $model->user()->attributeLabels()['receive_backend_email'],
        		'value' => BrainStaticList::janeinList(false)[$model->user()->receive_backend_email],
        	],
        	'availability',
            //'jobtype',
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
