<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CandidateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bewerber');
$this->params['breadcrumbs'][] = $this->title;

$helper = new HtmlHelper([
    'controllerName' => 'candidate',
    'template' => '{view} {update} {delete} {password}',
    'extraButtons' => [
        'password' => function ($url, $model, $key) {
        return Html::a('<img alt="" src="' . Yii::getAlias('@web') . '/web/images/icons/lock.png" width="20">', $url , ['title' => Yii::t('app', 'Kennwort ersetzen') , 'aria-label' => Yii::t('app', 'Kennwort ersetzen'), ]);
        }
    ],
    
        ]);


?>
<div class="candidate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Neuen Bewerber erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
        				'label' => Yii::t('app', 'Status'),
        				'headerOptions' => ['style' => 'width : 130px;'],
        				'value' => function($model){ return $model->user()->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', 'Deaktiv');}
        		],
        		$helper->render(),

        ],
    ]); ?>
</div>
