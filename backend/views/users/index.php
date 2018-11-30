<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\lib\UsersBase;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\UsersSearchBase */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-base-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Users'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn' , 'headerOptions' => ['style' => 'width : 30px;'],],

       		[
        		'label' => Yii::t('app', 'Username'),
       			'headerOptions' => ['style' => 'width : 130px;'],
        		'value' => function($model){ return $model->uname;}
        	],
        	[
        		'label' => Yii::t('app', 'Full Name'),
        		'value' => function($model){ return $model->fullname();}
        	],
        	[
        		'label' => Yii::t('app', 'Group'),
        		'headerOptions' => ['style' => 'width : 130px;'],
        		'value' => function($model){ return $model->group0->title;}
        	],
        	[
        		'label' => Yii::t('app', 'User Type'),
        		'headerOptions' => ['style' => 'width : 110px;'],
        		'value' => function($model){ return UsersBase::userTypeTitle($model->usertype);}
        	],
        	[
        		'label' => Yii::t('app', 'Permission'),
        		'headerOptions' => ['style' => 'width : 80px;'],
        		'value' => function($model){ return $model->permission;}
        	],
        	[
        		'label' => Yii::t('app', 'Status'),
        		'headerOptions' => ['style' => 'width : 60px;'],
        		'value' => function($model){ return UsersBase::statusTitle($model->status);}
        	],
        	 
            [
            	'class' => 'yii\grid\ActionColumn' , 
            	'headerOptions' => ['style' => 'width : 90px;'],
            	'template' => '{view} {update} {delete} {password}',
            	'buttons' => ['password' => function ($url, $model, $key) {
        			return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url , ['title' => Yii::t('app', 'Set Password') , 'aria-label' => Yii::t('app', 'Set Password'), ]);
    				},],
        	],
        ],
    ]); ?>
</div>

