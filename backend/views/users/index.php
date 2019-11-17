<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\lib\UsersBase;
use backend\components\HtmlHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\lib\UsersSearchBase */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;


$helper = new HtmlHelper([
    'controllerName' => 'users',
    'template' => '{view} {update} {delete} {password}',
    'extraButtons' => [
        'password' => function ($url, $model, $key) {
        return Html::a('<img alt="" src="' . Yii::getAlias('@web') . '/web/images/icons/lock.png" width="20">', $url , ['title' => Yii::t('app', 'Kennwort ersetzen') , 'aria-label' => Yii::t('app', 'Kennwort ersetzen'), ]);
        }
        ],
        
        ]);



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
        	 
        	$helper->render()
        ],
    ]); ?>
</div>

