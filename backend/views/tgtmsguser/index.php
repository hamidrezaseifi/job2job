<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\TargetMessageUsersBaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Nachricht Benutzer');
$this->params['breadcrumbs'][] = $this->title;

$helper = new HtmlHelper();

?>
<div class="target-message-users-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Nachricht Benutzer Erstellen'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
            	'class' => 'yii\grid\SerialColumn',
            	'headerOptions' => ['style' => 'width : 50px;'],
            ],
        		
            //'userid',
        	[
        		'label' => Yii::t('app', 'User'),
        		//'headerOptions' => ['style' => 'width : 70px;'],
        		'value' => function($model){ return $model->user->fullname();}
        	],
            [
        		'label' => Yii::t('app', 'Status'),
            	'headerOptions' => ['style' => 'width : 80px;'],
        		'value' => function($model){ return ($model->status == 1 ? Yii::t('app', 'Aktiv') : Yii::t('app', Inaktiv));}
    		],
        		
    		$helper->render(),
    		
        ],
    ]); ?>
</div>
