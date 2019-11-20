<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\EmailtextBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Email-Inhalt');
$this->params['breadcrumbs'][] = $this->title;


$helper = new HtmlHelper();

?>
<div class="emailtext-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width : 50px;'],
            ],
            
            //'id',
            [
                'label' => Yii::t('app', 'Titel'),
                'headerOptions' => ['style' => 'width : 250px;'],
                'value' => function($model){ return $model->title;}
            ],
            [
                'label' => Yii::t('app', 'Inhalt'),
                'headerOptions' => ['style' => 'width : auto;'],
                'format' =>'html',
                'value' => function($model){ return \Yii::$app->formatter->asNtext($model->text) ;}
            ],
            //'text:ntext',
           // 'texttype',
            [
        		'label' => Yii::t('app', 'Status'),
            	'headerOptions' => ['style' => 'width : 70px;'],
        		'value' => function($model){ return ($model->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', Inaktiv));}
    		],

    		$helper->render(),
        ],
    ]); ?>
</div>
